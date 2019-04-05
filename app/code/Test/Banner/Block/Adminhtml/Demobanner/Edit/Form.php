<?php

namespace Test\Banner\Block\Adminhtml\Demobanner\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    /**
     * @var \Test\Banner\Model\DemoFactory
     */
    protected $demoDataFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Test\Banner\Model\DemoFactory $demoDataFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Test\Banner\Model\DemoFactory $demoDataFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    ) {
        $this->demoDataFactory = $demoDataFactory;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form for render
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $demoId = $this->_coreRegistry->registry('current_demo_id');
        /** @var \Test\Banner\Model\DemoFactory $demoData */
        if ($demoId === null) {
            $demoData = $this->demoDataFactory->create();
        } else {
            $demoData = $this->demoDataFactory->create()->load($demoId);
        }

        $yesNo = [];
        $yesNo[0] = 'No';
        $yesNo[1] = 'Yes';

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Basic Information')]);

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Active'),
                'title' => __('Active'),
                'class' => 'required-entry',
                'required' => true,
                'values' => $yesNo,
            ]
        );

        $fieldset->addField(
            'banner',
            'editor',
            [
                'name' => 'banner',
                'label' => __('Banner'),
                'title' => __('Banner'),
                'rows' => '5',
                'cols' => '30',
                'wysiwyg' => true,
                'config' => $this->_wysiwygConfig->getConfig(),
                'required' => true
            ]
        );

        if ($demoData->getId() !== null) {
            // If edit add id
            $form->addField('demo_id', 'hidden', ['name' => 'demo_id', 'value' => $demoData->getId()]);
        }

        if ($this->_backendSession->getDemoData()) {
            $form->addValues($this->_backendSession->getDemoData());
            $this->_backendSession->setDemoData(null);
        } else {
            $form->addValues(
                [
                    'demo_id' => $demoData->getId(),
                    'title' => $demoData->getTitle(),
                    'is_active' => $demoData->getIsActive(),
                    'banner' => $demoData->getBanner(),
                ]
            );
        }

        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setMethod('post');
        $this->setForm($form);
    }
}
