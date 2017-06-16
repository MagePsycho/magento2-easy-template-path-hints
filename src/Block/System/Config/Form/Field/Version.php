<?php
namespace MagePsycho\Easypathhints\Block\System\Config\Form\Field;

use Magento\Framework\Data\Form\Element\AbstractElement;

/**
 * Version renderer with link
 *
 * @category   MagePsycho
 * @package    MagePsycho_Easypathhints
 * @author     Raj KB <magepsycho@gmail.com>
 * @website    http://www.magepsycho.com
 */
class Version extends \Magento\Config\Block\System\Config\Form\Field
{
    const EXTENSION_URL = 'http://www.magepsycho.com/magento-2-easy-template-path-hints.html';

    /**
     * @var \MagePsycho\Easypathhints\Helper\Data $helper
     */
    protected $_helper;

    /**
     * @param   \Magento\Backend\Block\Template\Context $context
     * @param   \MagePsycho\Easypathhints\Helper\Data   $helper
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \MagePsycho\Easypathhints\Helper\Data $helper
    ) {
        $this->_helper = $helper;
        parent::__construct($context);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $extensionVersion = $this->_helper->getExtensionVersion();
        $extensionTitle   = 'Easy Template Path Hints';
        $versionLabel     = sprintf(
            '<a href="%s" title="%s" target="_blank">%s</a>',
            self::EXTENSION_URL,
            $extensionTitle,
            $extensionVersion
        );
        $element->setValue($versionLabel);

        return $element->getValue();
    }
}