<?php

namespace Test\Banner\Controller\Adminhtml\Demobanner;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action as BackendAction;

class Index extends BackendAction
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Test_Banner::demobanner');
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Test_Banner::demobanner');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Home Banner Configuration'), __('Home Banner Configuration'));
        $resultPage->getConfig()->getTitle()->prepend(__('Home Banner Configuration'));

        return $resultPage;
    }
}