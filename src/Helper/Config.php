<?php

namespace MagePsycho\Easypathhints\Helper;

/**
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Config
{
    const XML_PATH_ENABLED     = 'magepsycho_easypathhints/general/enabled';
    const XML_PATH_DEBUG       = 'magepsycho_easypathhints/general/debug';
    const XML_PATH_ACCESS_CODE = 'magepsycho_easypathhints/general/access_code';
    const XML_PATH_SAVE_COOKIE = 'magepsycho_easypathhints/general/save_in_cookie';
    const XML_PATH_PROFILER    = 'magepsycho_easypathhints/general/show_profiler';

    const XML_PATH_DEBUG_TEMPLATE_FRONT = 'dev/debug/template_hints_storefront';
    const XML_PATH_DEBUG_TEMPLATE_ADMIN = 'dev/debug/template_hints_admin';
    const XML_PATH_DEBUG_BLOCKS         = 'dev/debug/template_hints_blocks';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function getConfigValue($xmlPath, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $xmlPath,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function isEnabled($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_ENABLED, $storeId);
    }

    public function isActive($storeId = null)
    {
        return $this->isEnabled($storeId);
    }

    public function getDebugStatus($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_DEBUG, $storeId);
    }

    public function getAccessCode($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_ACCESS_CODE, $storeId);
    }

    public function getSaveInCookie($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_SAVE_COOKIE, $storeId);
    }

    public function getShowProfiler($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_PROFILER, $storeId);
    }
}