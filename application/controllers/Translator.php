<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use \Statickidz\GoogleTranslate;

require_once 'admin/Base_Controller.php';

class Translator extends Base_Controller {

    /**
     * For translate
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function translate() {
        $result = '';
        if ($this->input->post('translate')) {
            /*
             * URL: https://github.com/statickidz/php-google-translate-free
             * Run these is terminal
             * sudo apt-get install php7.0-dom php7.0-mbstring
             * composer require statickidz/php-google-translate-free
             * 
             */
            $this->load->helper('security');
            $post = $this->security->xss_clean($this->input->post());

            $source = $post['from_lang'];
            $target = $post['to_lang'];
            $text = $post['content'];

            $trans = new GoogleTranslate();
            $flag = 1;
            while ($flag) {
                $result = $trans->translate($source, $target, $text);
                if ($result) {
                    $flag = 0;
                }
            }
        }

        $user_type = ($this->aauth->getUserType() == 'employee') ? 'admin' : $this->aauth->getUserType();
        $this->setData('user_type', $user_type);

        $langs = $this->translator_model->getAllLanguages(0, 1);
        $this->setData('langs', $langs);
        $this->setData('result', $result);
        $this->setData('title', lang('menu_name_184'));
        $this->loadView();
    }

    /**
     * For language translate
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function lang_translate() {
        $this->load->helper('security');
        $post = $this->security->xss_clean($this->input->get()); 
        
        $tran = lang('please_enter_all_required_fields');
        if ($post['from_lang'] && $post['to_lang'] && $post['content']) {
            $source = $post['from_lang'];
            $target = $post['to_lang'];
            $text = $post['content'];

            $trans = new GoogleTranslate();
            $flag = 1;
            while ($flag) {
                $result = $trans->translate($source, $target, $text);
                if ($result) {
                    $flag = 0;
                }
            }

            if ($result) {
                $tran = lang('result') . ' :- ' . $result;
            } else {
                $tran = lang('something_went_wrong_pls_try_again');
            }
        }
        echo $tran;
        exit();
    }

    /**
     * For optimize Languages like same languages were added separate language files remove that added common files for accessing
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     */
    function optimize_english_folder() {
        $this->load->helper('file');

        $lang_name = 'english';
        $dir = FCPATH . 'application/language/english';

        $results = $this->getAllLanguageFiles($dir);

        $file = '';
        $lang_data = $this->getContent(fopen(FCPATH . 'application/language/english/common_lang.php', "r"));

        foreach ($results as $lf) {
            if (!strpos($lf, 'index.html')) {
                echo '<p>' . $lf . PHP_EOL;
                $file = fopen($lf, "r") or exit("Unable to open file!");
                $converted_data = $this->optimize($file, $lang_data, $lf);
                if ($converted_data) {
                    file_put_contents($lf, "");
                    write_file($lf, $converted_data, 'a+');
                }
                fclose($file);
            }
        }
        die('<p>Finished');
    }

    /**
     * For automatically translate the languages
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $lang_name
     * @param string $dir
     */
    function translate_all_language_files($lang_name = '', $dir = '') {
        $this->load->helper('file');
        $trans = new GoogleTranslate();

        $source = 'en';

        //echo 'Start Converting ' . $lang_name . PHP_EOL;
        $all_lan = $this->translator_model->getAllLanguages();
        foreach ($all_lan as $al) {
            $lang_name = $al['lang_name'];
            $dir = FCPATH . 'application/language/' . $al['language_folder'];

            $target = $al['lang_code'];
            if ($source != $target) {
                if ($lang_name && $dir) {
                    $results = $this->getAllLanguageFiles($dir);

                    foreach ($results as $lf) {
                        //if (!strpos($lf, 'index.html') || !strpos($lf, 'validation_lang.php')) {
                        if (!strpos($lf, 'index.html')) {
                            echo PHP_EOL . $lf . PHP_EOL;
                            if (!$this->translator_model->checkTranslatedStatus($lf)) {
                                $res = $this->translator_model->insertTranslatedFiles($lf);
                                if ($res) {
                                    $file = fopen($lf, "r") or exit("Unable to open file!");
                                    $converted_data = $this->fileConvertion($file, $source, $target);
                                    if ($converted_data) {
                                        file_put_contents($lf, "");
                                        write_file($lf, $converted_data, 'a+');
                                        $this->translator_model->updateTranslatedFile($lf);
                                    }
                                    fclose($file);
                                }
                            }
                        }
                    }
                } else {
                    echo '<p>Invalid Parameters';
                }
            }
        }
        die('<p>Finished');
    }

    /**
     * For translate new fields were we added
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $eng_flag
     */
    function translate_new_fields($eng_flag = 0) {
        $this->load->helper('file');
        $trans = new GoogleTranslate();
        $data = $this->translator_model->getUntraslatedData();
        $languages = $this->translator_model->getAllLanguages($eng_flag);
        $source = 'en';
        foreach ($data as $d) {
            $i = $j = 0;
            foreach ($languages as $l) {
                $i++;
                $target = $l['lang_code'];

                $text = $d['in_english'];
                $field = $d['field_name'];
                $flag = 1;
                while ($flag) {
                    $result = $trans->translate($source, $target, $text);
                    if ($result) {
                        $flag = 0;
                    }
                }

                if ($result) {
                    $file_path = FCPATH . 'application/language/' . $l['language_folder'] . '/common_lang.php';
                    if (file_exists($file_path)) {
                        $result = str_replace("'", '`', $result);
                        $text = "$" . "lang['" . $field . "']='" . $result . "';\n";
                        if (write_file($file_path, $text, 'a+')) {
                            $j++;
                        }
                    }
                }
            }
            if ($i == $j && $j > 0) {
                $this->translator_model->updateConversionStatus($d['id']);
            }
        }

        $untranslated_fields = $this->translator_model->getUntranslatedFields();
        if ($untranslated_fields) {
            echo 'no';
        } else {
            echo 'yes';
        }
        exit();
    }

    /**
     * For getting all language files
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $dir
     * @return type
     */
    function getAllLanguageFiles($dir) {
        $this->load->helper('file');

        $files = scandir($dir);
        $results = $folders = array();
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $folders[] = $path;
            }
        }

        foreach ($folders as $k => $val) {
            $files = scandir($val);
            foreach ($files as $key => $value) {
                $path = realpath($val . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    $results[] = $path;
                }
            }
        }

        return $results;
    }

    /**
     * For File Conversion example specific language folder
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $file
     * @param type $source
     * @param type $target
     * @return type
     */
    function fileConvertion($file, $source, $target) {
        $this->load->helper('file');
        $trans = new GoogleTranslate();

        $converted_data = '<?php ' . "if ( ! defined('BASEPATH')) exit('No direct script access allowed');" . PHP_EOL;
        $failed_data = '//failed data' . PHP_EOL . '/*';
        $i = 0;
        $failed_data_array = array();
        while (!feof($file)) {
            echo '---';
            $result = '';
            $flag = 0;
            $content = fgets($file);
            $data = explode("=", $content);
            if (count($data) == 2) {
                $text = $data['1'];
                if ($text != '') {
                    if (preg_match("/'([^']+)'/", $text, $m) || preg_match('/"([^"]+)"/', $text, $m)) {
                        $conv_text = $m[1];
                        $conv_text = str_replace("{field}", '****', $conv_text);
                        $conv_text = str_replace("{param}", '*****', $conv_text);
                        $conv_text = str_replace("([a-zA-Z0-9])", '******', $conv_text);
                        $conv_text = str_replace("`", "'", $conv_text);
                        try {
                            $conv_status = TRUE;
                            while ($conv_status) {
                                $trans_his = $this->translator_model->getTranslationHistory($source, $target, $conv_text);
                                if ($trans_his) {
                                    $result = $trans_his;
                                } else {
                                    sleep(2);
                                    $result = $trans->translate($source, $target, $conv_text);
                                    if ($result) {
                                        $this->translator_model->updateTranslationHistory($source, $target, $conv_text, $result);
                                    }
                                }
                                if ($result) {
                                    $conv_status = FALSE;
                                }
                            }
                        } catch (Exception $e) {
                            echo 'Message: ' . $e->getMessage();
                        }

                        if ($result) {
                            //$result = str_replace("'", '`', $result);
                            $result = str_replace("******", '([a-zA-Z0-9])', $result);
                            $result = str_replace("*****", '{param}', $result);
                            $result = str_replace("****", '{field}', $result);

                            $flag = 1;
                            if (strpos($result, "'")) {
                                $data['1'] = '"' . $result . '";' . PHP_EOL;
                            } else {
                                $data['1'] = "'" . $result . "';" . PHP_EOL;
                            }

                            $arr = array($data[0], $data[1]);
                            $new = implode('=', $arr);

                            //echo PHP_EOL . $text . '------' . $result;
                        }
                    }
                }
                if ($flag) {
                    $converted_data .= $new;
                } else {
                    $failed_data .= $content;
                    $failed_data_array[] = $content;
                }
            } else {
                $failed_data .= $content;
                $failed_data_array[] = $content;
            }
        }
        return $converted_data . PHP_EOL;
        //return $converted_data . $failed_data . '*/' . PHP_EOL;
    }

    /**
     * For getting the file contents
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * 
     * @param type $file
     * @return type
     */
    function getContent($file) {
        $this->load->helper('file');
        $lang_data = array();
        while (!feof($file)) {
            $content = fgets($file);
            $data = explode("=", $content);
            if (count($data) == 2) {
                $lang_data[] = trim($data[0]);
            }
        }
        return $lang_data;
    }

    /**
     * For optimizing
     * @author Techffodils Technologies LLP
     * @copyright (c) 2017, Techffodils Technologies
     * @param type $file
     * @param type $common_data
     * @param type $lf
     * @return type
     */
    function optimize($file, $common_data, $lf = '') {
        $this->load->helper('file');
        $converted_data = '<?php ' . " if ( ! defined('BASEPATH')) exit('No direct script access allowed');" . PHP_EOL;
        if ($lf == FCPATH . 'application/language/english/common_lang.php') {
            $common_data = array();
        }
        while (!feof($file)) {
            echo '---';
            $content = fgets($file);
            $data = explode("=", $content);
            if (count($data) == 2) {
                if (!in_array(trim($data['0']), $common_data)) {
                    $converted_data .= $content;
                    $common_data[] = trim($data[0]);
                }
            }
        }
        return $converted_data;
    }

}
