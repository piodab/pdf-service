<?php

namespace Modules\Core\Services\PDF\Drivers;

use Modules\Core\Services\PDF\Interfaces\ExportDriver;
use Modules\Core\Services\PDF\Interfaces\WIthPdf;

class PdfDriver implements ExportDriver
{
    public const DRIVER_NAME = 'pdf';

    private array $parameters;
    private string $patchToTemplate;

    public function generateContent(WIthPdf $withPdfMode): self
    {
        $this->parameters = $withPdfMode->getPdfParams();

        return $this;
    }

    public function setTemplatePatch(string $patchToTemplate): self
    {
        $this->patchToTemplate = $patchToTemplate;

        return $this;
    }

    public function stream()
    {
        $pdf = \PDF::loadView($this->patchToTemplate, ['params' => $this->parameters]);

        return $pdf->stream();
    }

    public function download()
    {
        $pdf = \PDF::loadView($this->patchToTemplate, ['params' => $this->parameters]);
        $fileName = config('pdf-service.drivers.'.self::DRIVER_NAME.'.file_name');

        return $pdf->download($fileName);
    }
}