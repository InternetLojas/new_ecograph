<?php

Class EdocBuilder {

    /**
     * Payments constructor
     * 
     */
    /* ============================================================== */
    /* 				Controller ACESSO EDOCBUILDER                     */
    /* ============================================================== */

    public function getParans($callback = '') {
        if (empty($callback)) {
            $edoc = Config::get('edocbuilder');
            return $edoc;
        }
    }

    public function getDoc($id) {
        $doc = Template::find($id);
        return array('docCode' => $doc->docid,
            'docPwd' => $doc->docpass);
    }

    public function getURL($api_parans) {
        $url_api = 'https://client.edocbuilder.com/';
        $url_api .= 'html5plus.aspx?';
        //Forma URL
        foreach ($api_parans as $get_key => $get_value) {
            $url_api .= $get_key . '=' . urlencode($get_value) . '&';
        }
        return $url_api;
    }

}
