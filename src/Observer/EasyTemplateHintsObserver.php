<?php
namespace MagePsycho\Easypathhints\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\MutableScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use MagePsycho\Easypathhints\Helper\Data as EasypathhintsHelper;

/**
 * Observer Class
 *
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 */
class EasyTemplateHintsObserver implements ObserverInterface
{

    /**
     * @var EasypathhintsHelper $helper
     */
    protected $_helper;

    /**
     * @var MutableScopeConfigInterface
     */
    protected $_mutableConfig;

    /**
     * @param EasypathhintsHelper $helper
     * @param MutableScopeConfigInterface $mutableConfig
     */
    public function __construct(
        EasypathhintsHelper $helper,
        MutableScopeConfigInterface $mutableConfig
    ) {
        $this->_helper          = $helper;
        $this->_mutableConfig   = $mutableConfig;
    }

    public function execute(Observer $observer)
    {
        $this->_helper->log($observer->getEvent()->getName(), true);
        if ($this->_helper->shouldShowTemplatePathHints()) {

            $this->_mutableConfig->setValue(
                EasypathhintsHelper::XML_PATH_DEBUG_TEMPLATE_FRONT,
                1,
                ScopeInterface::SCOPE_STORE
            );

            $this->_mutableConfig->setValue(
                EasypathhintsHelper::XML_PATH_DEBUG_TEMPLATE_ADMIN,
                1,
                ScopeInterface::SCOPE_STORE
            );

            $this->_mutableConfig->setValue(
                EasypathhintsHelper::XML_PATH_DEBUG_BLOCKS,
                1,
                ScopeInterface::SCOPE_STORE
            );

            /*if ($this->_helper->getShowProfiler()) {
                $_SERVER['MAGE_PROFILER'] = 'html';
            }*/
        }
        return $this;
    }
}