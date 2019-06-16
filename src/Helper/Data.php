<?php

namespace MagePsycho\Easypathhints\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Module\ModuleListInterface;

/**
 * Utility Helper
 *
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    https://www.magepsycho.com
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \MagePsycho\Easypathhints\Logger\Logger
     */
    protected $customLogger;

    /**
     * @var \MagePsycho\Easypathhints\Helper\Config
     */
    protected $configHelper;

    /**
     * @var ModuleListInterface
     */
    protected $moduleList;

    /**
     * @var \MagePsycho\Easypathhints\Model\TemplateHintCookie
     */
    protected $templateHintCookie;

    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $mageMetaData;

    public function __construct(
        Context $context,
        \MagePsycho\Easypathhints\Logger\Logger $customLogger,
        \MagePsycho\Easypathhints\Helper\Config $configHelper,
        \MagePsycho\Easypathhints\Model\TemplateHintCookie $templateHintCookie,
        ModuleListInterface $moduleList,
        \Magento\Framework\App\ProductMetadataInterface $mageMetaData
    ) {
        $this->customLogger            = $customLogger;
        $this->configHelper            = $configHelper;
        $this->templateHintCookie      = $templateHintCookie;
        $this->moduleList              = $moduleList;
        $this->mageMetaData            = $mageMetaData;

        parent::__construct($context);
    }

    public function shouldShowTemplatePathHints()
    {
        if (!$this->configHelper->isActive()) {
            return false;
        }
        $tp                 = $this->_getRequest()->getParam('tp');
        $accessCode         = $this->_getRequest()->getParam('code');
        $dbAccessCode       = $this->configHelper->getAccessCode();
        $dbCookieStatus     = $this->configHelper->getSaveInCookie();
        $cookieStatus       = $this->_getRequest()->getParam('cookie', -1);

        $checkAccessCode = true;
        if (! empty($dbAccessCode)) {
            $checkAccessCode = ($dbAccessCode == $accessCode)
                ? true
                : false;
        }

        // set/delete cookie value
        if ($dbCookieStatus) {
            if (1 == $cookieStatus) {
                $this->templateHintCookie->set(1);
            } elseif (0 == $cookieStatus) {
                $this->templateHintCookie->delete();
            }
        }

        if (($tp && $checkAccessCode)
            || $this->templateHintCookie->get()
        ) {
            return true;
        }

        return false;
    }

    public function getExtensionVersion()
    {
        $moduleCode = 'MagePsycho_Easypathhints';
        $moduleInfo = $this->moduleList->getOne($moduleCode);
        return $moduleInfo['setup_version'];
    }

    public function getMagentoVersion()
    {
        return $this->mageMetaData->getVersion();
    }

    /**
     * Logging Utility
     *
     * @param $message
     * @param bool|false $useSeparator
     */
    public function log($message, $useSeparator = false)
    {
        if ($this->configHelper->getDebugStatus()) {
            if ($useSeparator) {
                $this->customLogger->customLog(str_repeat('=', 100));
            }

            $this->customLogger->customLog($message);
        }
    }
}
