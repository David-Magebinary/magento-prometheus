<?php
/**
 * Copyright 2017 www.sitewards.com
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category Sitewards
 * @package  Sitewards_Prometheus
 * @license  apache-2.0
 */

use Prometheus\RenderTextFormat;

class Sitewards_Prometheus_IndexController extends Mage_Core_Controller_Front_Action
{
    /**
     * Renders the Magento metrics
     *
     * @todo: Render the text or HTML version depending on the request headers
     */
    public function indexAction()
    {
        /** @var Sitewards_Prometheus_Model_Resource_Metrics $oResourceModel */
        $oResourceModel = Mage::getResourceSingleton('sitewards_prometheus/metrics');

        $oRenderer = new RenderTextFormat();
        $sContent = $oRenderer->render($oResourceModel->getMetricFamilySamples());
        $this->getResponse()->setBody($sContent);
        $this->getResponse()->setHeader('Content-type', RenderTextFormat::MIME_TYPE);
    }
}