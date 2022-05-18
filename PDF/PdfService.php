<?php

namespace Modules\Core\Services\PDF;

use Modules\Core\Services\PDF\Interfaces\ExportDriver;
use Modules\Core\Services\PDF\Interfaces\WIthPdf;

class PdfService
{
    /** Examples of use
     (new PdfService())->setDriver('pdf')
    ->setModel(app(StockSku::class)->first())
    ->setTemplatePatch('core::pdf-template.format-a4.pdf-a4')
    ->download();
     */

    private string $patchToTemplate;
    private ExportDriver $exportDriver;
    private WIthPdf $withPdfModel;

    public function setDriver(string $driverName): self
    {
        $driversInConfig = array_keys(config('pdf-service.drivers'));
        $driverName = in_array($driverName, $driversInConfig)
            ? $driverName
            : config('pdf-service.default_driver');
        $this->exportDriver = app(config('pdf-service.drivers.'.$driverName.'.driver'));

        return $this;
    }

    public function setModel(WIthPdf $withPdfModel): self
    {
        $this->withPdfModel = $withPdfModel;

        return $this;
    }

    //eg 'core::pdf-template.format-a4.pdf-a4'
    public function setTemplatePatch(string $patchToTemplate): self
    {
        $this->patchToTemplate = $patchToTemplate;

        return $this;
    }

    public function stream()
    {
        return $this->exportDriver
            ->setTemplatePatch($this->patchToTemplate)
            ->generateContent($this->withPdfModel)
            ->stream();
    }

    public function download()
    {
        return $this->exportDriver
            ->setTemplatePatch($this->patchToTemplate)
            ->generateContent($this->withPdfModel)
            ->download();
    }
}