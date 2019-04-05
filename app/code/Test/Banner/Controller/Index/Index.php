<?php

namespace Test\Banner\Controller\Index;
use Magento\Framework\App\Action\Action;

class Index extends Action
    {
    /**
    * @var \Magento\Framework\View\Result\PageFactory
    */
    protected $resultPageFactory;
    /**
    * @param \Magento\Framework\App\Action\Context $context
    * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
    */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory
        $resultPageFactory
        )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
    * Renders Banner Index
    */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}