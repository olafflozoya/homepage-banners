<?php

namespace Test\Banner\Controller\Adminhtml\Demobanner;

use Magento\Backend\App\Action;

class Save extends Action
{

    /**
     * Demo factory
     *
     * @var \Test\Banner\Model\DemoFactory
     */
    private $demoFactory;

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
     * @param \Test\Banner\Model\DemoFactory $demoFactory
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Test\Banner\Model\DemoFactory $demoFactory,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->demoFactory = $demoFactory;
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
     * Save Banner item.
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('demo_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            if ($id !== null) {
                $demoData = $this->demoFactory->create()->load((int)$id);
            } else {
                $demoData = $this->demoFactory->create();
            }
            $data = $this->getRequest()->getParams();
            $demoData->setData($data)->save();

            $this->messageManager->addSuccess(__('Banner saved.'));
            $resultRedirect->setPath('banner/demobanner');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
            $this->_getSession()->setDemoData($data);

            $resultRedirect->setPath('banner/demobanner/edit', ['demo_id' => $id]);
        }
        return $resultRedirect;
    }
} 
