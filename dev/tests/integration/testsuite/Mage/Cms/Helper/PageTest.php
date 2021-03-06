<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Cms
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Cms_Helper_PageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @magentoAppIsolation enabled
     * @magentoDataFixture Mage/Cms/_files/pages.php
     */
    public function testRenderPage()
    {
        $page = Mage::getSingleton('Mage_Cms_Model_Page');
        $page->load('page_design_modern', 'identifier'); // fixture
        /** @var $helper Mage_Cms_Helper_Page */
        $helper = Mage::helper('Mage_Cms_Helper_Page');
        $result = $helper->renderPage(
            Mage::getModel(
                'Mage_Core_Controller_Front_Action',
                array(
                    new Magento_Test_Request(),
                    new Magento_Test_Response(),
                    Mage::getObjectManager(),
                    Mage::getObjectManager()->get('Mage_Core_Controller_Varien_Front'),
                    Mage::getObjectManager()->get('Mage_Core_Model_Layout_Factory'),
                    'frontend'
                )
            ),
            $page->getId()
        );
        $this->assertEquals('default/modern', Mage::getDesign()->getDesignTheme()->getThemePath());
        $this->assertTrue($result);
    }
}
