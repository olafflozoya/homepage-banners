<?php

namespace Test\Banner\Controller\Adminhtml\Demobanner;

use Magento\Backend\App\Action;

class NewAction extends Action
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Initialize Group Controller
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Test_Banner::demobanner');
    }

    /**
     * Edit Demobanner item. Forward to new action.
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $demoId = $this->getRequest()->getParam('demo_id');
        $this->_coreRegistry->register('current_demo_id', $demoId);

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        if ($demoId === null) {
            $resultPage->addBreadcrumb(__('New Banner'), __('New Banner'));
            $resultPage->getConfig()->getTitle()->prepend(__('New Banner'));
        } else {
            $resultPage->addBreadcrumb(__('Edit Banner'), __('Edit Banner'));
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Banner'));
        }

        $resultPage->getLayout()
            ->addBlock('Test\Banner\Block\Adminhtml\Demobanner\Edit', 'demobanner', 'content')
            ->setEditMode((bool)$demoId);

        return $resultPage;
    }
} 
