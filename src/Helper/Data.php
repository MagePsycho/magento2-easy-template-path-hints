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
 * @website    http://www.magepsycho.com
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

    public function __construct(
        Context $context,
        \MagePsycho\Easypathhints\Logger\Logger $customLogger,
        \MagePsycho\Easypathhints\Helper\Config $configHelper,
        \MagePsycho\Easypathhints\Model\TemplateHintCookie $templateHintCookie,
        ModuleListInterface $moduleList
    ) {
        $this->customLogger            = $customLogger;
        $this->configHelper            = $configHelper;
        $this->templateHintCookie      = $templateHintCookie;
        $this->moduleList              = $moduleList;

        parent::__construct($context);
    }

    public function shouldShowTemplatePathHints()
    {
        $tp                 = $this->_getRequest()->getParam('tp');
        $accessCode         = $this->_getRequest()->getParam('code');
        $isActive           = $this->configHelper->isActive();
        $dbAccessCode       = $this->configHelper->getAccessCode();
        $dbCookieStatus     = $this->configHelper->getSaveInCookie();
        $cookieStatus       = $this->_getRequest()->getParam('cookie', -1);

        $checkAccessCode = true;
        if ( ! empty($dbAccessCode)) {
            $checkAccessCode = ($dbAccessCode == $accessCode)
                ? true
                : false;
        }

        // set/delete cookie value
        if ($dbCookieStatus) {
            if (1 == $cookieStatus) {
                $this->templateHintCookie->set(1);
            } else if (0 == $cookieStatus) {
                $this->templateHintCookie->delete();
            }
        }

        if (   ($tp && $isActive && $checkAccessCode)
            || ($isActive && $this->templateHintCookie->get())
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