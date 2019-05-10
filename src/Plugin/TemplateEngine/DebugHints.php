<?php

namespace MagePsycho\Easypathhints\Plugin\TemplateEngine;
use Magento\Developer\Model\TemplateEngine\Decorator\DebugHintsFactory;
use Magento\Framework\View\TemplateEngineFactory;
use Magento\Framework\View\TemplateEngineInterface;
use MagePsycho\Easypathhints\Helper\Data as EasyPathHintsHelper;


/**
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DebugHints
{
    /**
     * @var EasyPathHintsHelper
     */
    private $easyPathHintsHelper;

    /**
     * @var DebugHintsFactory
     */
    protected $debugHintsFactory;

    public function __construct(
        EasyPathHintsHelper $easyPathHintsHelper,
        DebugHintsFactory $debugHintsFactory
    ) {
        $this->easyPathHintsHelper = $easyPathHintsHelper;
        $this->debugHintsFactory = $debugHintsFactory;
    }

    public function afterCreate(
        TemplateEngineFactory $subject,
        TemplateEngineInterface $invocationResult
    ) {
        if ($this->easyPathHintsHelper->shouldShowTemplatePathHints()) {
            $showBlockHints = 1;
            return $this->debugHintsFactory->create([
                'subject' => $invocationResult,
                'showBlockHints' => $showBlockHints,
            ]);
        }
        return $invocationResult;
    }
}