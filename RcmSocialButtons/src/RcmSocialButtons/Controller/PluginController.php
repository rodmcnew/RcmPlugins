<?php

/**
 * Plugin Controller
 *
 * This is the main controller for this plugin
 *
 * PHP version 5.3
 *
 * LICENSE: No License yet
 *
 * @category  Reliv
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 */
namespace RcmSocialButtons\Controller;

use Rcm\Plugin\BaseController;
use Rcm\Plugin\PluginInterface;

/**
 * Plugin Controller
 *
 * This is the main controller for this plugin
 *
 * @category  Reliv
 * @author    Rod McNew <rmcnew@relivinc.com>
 * @copyright 2012 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: 1.0
 *
 */
class PluginController
    extends BaseController
    implements PluginInterface
{
    function availableButtonsAdminAjaxAction()
    {
        $config = $this->getServiceLocator()->get('config');
        $availableButtons
            = json_encode(
            $config['rcmPlugin']['RcmSocialButtons']['availableButtons']
        );
        header('Content-type: application/json');
        exit($availableButtons);
    }
}