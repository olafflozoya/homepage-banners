<?php

namespace Test\Banner\Block\Adminhtml\Demobanner;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Current demo record id
     *
     * @var bool|int
     */
    protected $demoId=false;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Remove Delete button if record can't be deleted.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'demo_id';
        $this->_controller = 'adminhtml_demobanner';
        $this->_blockGroup = 'Test_Banner';

        parent::_construct();

        $demoId = $this->getDemoId();
        if (!$demoId) {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve the header text, either editing an existing record or creating a new one.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $demoId = $this->getDemoId();
        if (!$demoId) {
            return __('New Banner');
        } else {
            return __('Edit Banner');
        }
    }

    public function getDemoId()
    {
        if (!$this->demoId) {
            $this->demoId=$this->coreRegistry->registry('current_demo_id');
        }
        return $this->demoId;
    }

}
