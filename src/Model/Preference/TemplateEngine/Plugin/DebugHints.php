<?php

namespace MagePsycho\Easypathhints\Model\Preference\TemplateEngine\Plugin;

use Magento\Developer\Helper\Data as DevHelper;
use Magento\Developer\Model\TemplateEngine\Decorator\DebugHintsFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\TemplateEngineFactory;
use Magento\Framework\View\TemplateEngineInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class DebugHints extends \Magento\Developer\Model\TemplateEngine\Plugin\DebugHints
{
    protected $easyPathHintsHelper;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager,
        DevHelper $devHelper,
        DebugHintsFactory $debugHintsFactory,
        $debugHintsPath,
        \MagePsycho\Easypathhints\Helper\Data $easyPathHintsHelper
    ) {
        parent::__construct($scopeConfig, $storeManager, $devHelper, $debugHintsFactory, $debugHintsPath);

        $this->easyPathHintsHelper = $easyPathHintsHelper;
    }

    public function afterCreate(
        TemplateEngineFactory $subject,
        TemplateEngineInterface $invocationResult
    ) {
        $storeCode = $this->storeManager->getStore()->getCode();
        if (( $this->easyPathHintsHelper->shouldShowTemplatePathHints()
            || $this->scopeConfig->getValue($this->debugHintsPath, ScopeInterface::SCOPE_STORE, $storeCode) )
            && $this->devHelper->isDevAllowed()
        ) {
            $showBlockHints = $this->scopeConfig->getValue(
                self::XML_PATH_DEBUG_TEMPLATE_HINTS_BLOCKS,
                ScopeInterface::SCOPE_STORE,
                $storeCode
            );
            return $this->debugHintsFactory->create([
                'subject' => $invocationResult,
                'showBlockHints' => $showBlockHints,
            ]);
        }
        return $invocationResult;
    }
}