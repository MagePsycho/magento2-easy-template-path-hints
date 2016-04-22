<?php
namespace MagePsycho\Easypathhints\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Stdlib\Cookie\CookieMetadataFactory;
use Magento\Framework\Stdlib\CookieManagerInterface;
use Magento\Framework\Module\ModuleListInterface;

/**
 * Utility Helper
 *
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{

    const XML_PATH_ENABLED          = 'magepsycho_easypathhints/general/enabled';
    const XML_PATH_DEBUG            = 'magepsycho_easypathhints/general/debug';
    const XML_PATH_ACCESS_CODE      = 'magepsycho_easypathhints/general/access_code';
    const XML_PATH_SAVE_IN_COOKIE   = 'magepsycho_easypathhints/general/save_in_cookie';
    const XML_PATH_SHOW_PROFILER    = 'magepsycho_easypathhints/general/show_profiler';

    const XML_PATH_DEV_DEBUG_TEMPLATE_HINTS_STOREFRONT = 'dev/debug/template_hints_storefront';
    const XML_PATH_DEV_DEBUG_TEMPLATE_HINTS_ADMIN = 'dev/debug/template_hints_admin';
    const XML_PATH_DEV_DEBUG_TEMPLATE_HINTS_BLOCKS = 'dev/debug/template_hints_blocks';

    /**
    * Cookie key for template path
    */
    const COOKIE_NAME = 'mp-etph';

    /**
     * Cookie path
     */
    const COOKIE_PATH = '/';

    /**
     * Cookie lifetime value
     */
    const COOKIE_LIFETIME = 600;

    /**
     * @var CookieMetadataFactory
     */
    protected $_cookieMetadataFactory;

    /**
     * @var CookieManagerInterface
     */
    protected $_cookieManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;

    /**
     * @var ModuleListInterface
     */
    protected $_moduleList;

    /**
     * @param Context $context
     * @param CookieMetadataFactory $cookieMetadataFactory
     * @param CookieManagerInterface $cookieManager
     * @param ModuleListInterface $moduleList
     */
    public function __construct(
        Context $context,
        CookieMetadataFactory $cookieMetadataFactory,
        CookieManagerInterface $cookieManager,
        ModuleListInterface $moduleList
    ) {
        $this->_cookieMetadataFactory   = $cookieMetadataFactory;
        $this->_cookieManager           = $cookieManager;
        $this->_logger                  = $context->getLogger();
        $this->_moduleList              = $moduleList;

        parent::__construct($context);
    }

    /**
     * Check if enabled
     *
     * @return string|null
     */
    public function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getDebugStatus()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_DEBUG,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getAccessCode()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ACCESS_CODE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getSaveInCookie()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SAVE_IN_COOKIE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getShowProfiler()
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_SHOW_PROFILER,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function shouldShowTemplatePathHints()
    {

        $isActive			= $this->isEnabled();
        $tp					= $this->_getRequest()->getParam('tp');
        $accessCode			= $this->_getRequest()->getParam('code');

        $dbAccessCode		= $this->getAccessCode();
        $dbCookieStatus     = $this->getSaveInCookie();

        $cookieStatus       = $this->_getRequest()->getParam('cookie', -1);

        $checkAccessCode = true;
        if ( ! empty($dbAccessCode)) {
            $checkAccessCode = ($dbAccessCode == $accessCode) ? true : false;
        }

        if ($dbCookieStatus) {
            if (1 == $cookieStatus) {
                $this->setDebugCookie(1);
            } else if (0 == $cookieStatus) {
                $this->deleteDebugCookie();
            }
        }

        if (($tp && $isActive && $checkAccessCode)
            || ($isActive && $this->getDebugCookie())
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Set Cookie
     *
     * @param $value
     */
    public function setDebugCookie($value)
    {
        $publicCookieMetadata = $this->_cookieMetadataFactory
            ->createPublicCookieMetadata()
        ;
        $this->_cookieManager->setPublicCookie(
            self::COOKIE_NAME,
            $value,
            $publicCookieMetadata
        );
    }

    /**
     * Get debug value from cookie.
     *
     * @return null|string
     */
    public function getDebugCookie()
    {
        return $this->_cookieManager->getCookie(self::COOKIE_NAME);
    }

    /**
     * Delete debug cookie.
     *
     * @return $this
     */
    public function deleteDebugCookie()
    {
        $cookieMetadata = $this->_cookieMetadataFactory->createPublicCookieMetadata();
        $this->_cookieManager->deleteCookie(self::COOKIE_NAME, $cookieMetadata);
        return $this;
    }

    public function getExtensionVersion()
    {
        $moduleCode = 'MagePsycho_Easypathhints';
        $moduleInfo = $this->_moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }

    /**
     * Logging Utility
     *
     * @param $message
     * @param bool|false $useSeparator
     */
    public function log($message, $useSeparator = false)
    {
        if ($this->getDebugStatus()) {
            if ($useSeparator) {
                $this->_logger->addDebug(str_repeat('=', 100));
            }

            $this->_logger->addDebug($message);
        }
    }
}