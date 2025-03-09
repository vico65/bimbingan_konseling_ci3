<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Include dompdf autoloader
// require_once APPPATH . 'third_party/dompdf/autoload.inc.php';
require_once APPPATH . '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    protected $dompdf;

    public function __construct()
    {
        // Set options dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Enable remote file access (for images, etc.)
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation)
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename, $options = [])
    {
        $this->dompdf->stream($filename, $options);
    }
}
