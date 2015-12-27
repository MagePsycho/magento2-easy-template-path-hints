<?php
namespace MagePsycho\Easypathhints\Observer;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
/**
 * Observer Class
 *
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class EasyTemplateHintsObserver implements ObserverInterface
{

	/**
	 * @var \MagePsycho\Easypathhints\Helper\Data $helper
	 */
	protected $_helper;

	/**
	 * @var \Magento\Framework\App\Config\MutableScopeConfigInterface
	 */
	protected $_mutableConfig;

	/**
	 * @param \MagePsycho\Easypathhints\Helper\Data $helper
	 * @param \Magento\Framework\App\Config\MutableScopeConfigInterface $mutableConfig
	 */
	public function __construct(
		\MagePsycho\Easypathhints\Helper\Data $helper,
		\Magento\Framework\App\Config\MutableScopeConfigInterface $mutableConfig
	) {
		$this->_helper          = $helper;
		$this->_mutableConfig   = $mutableConfig;
	}




	public function execute(\Magento\Framework\Event\Observer $observer)
	{

		$this->_helper->log($observer->getEvent()->getName(), true);
		if ($this->_helper->shouldShowTemplatePathHints()) {

			$this->_mutableConfig->setValue(\MagePsycho\Easypathhints\Helper\Data::XML_PATH_DEV_DEBUG_TEMPLATE_HINTS, 1, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
			$this->_mutableConfig->setValue(\MagePsycho\Easypathhints\Helper\Data::XML_PATH_DEV_DEBUG_TEMPLATE_HINTS_BLOCKS, 1, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

			if ($this->_helper->getShowProfiler()) {
				$_SERVER['MAGE_PROFILER'] = 'html';
			}
		}
		return $this;
	}
}