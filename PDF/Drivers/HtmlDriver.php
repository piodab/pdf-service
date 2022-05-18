<?php

namespace Modules\Core\Services\PDF\Drivers;

use Modules\Core\Services\PDF\Interfaces\ExportDriver;
use Modules\Core\Services\PDF\Interfaces\WIthPdf;

class HtmlDriver implements ExportDriver
{
    public const DRIVER_NAME = 'html';

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
        return view($this->patchToTemplate, ['params' => $this->parameters]);
    }

    public function download()
    {
        $view = view($this->patchToTemplate, ['params' => $this->parameters])->render();
        header("Content-type: text/html");
        header("Content-Disposition: attachment; filename=view.html");

        return $view;
    }
}