<?php

namespace Modules\Core\Services\PDF\Interfaces;

interface ExportDriver
{
    public function generateContent(WIthPdf $withPdfMode): self;
    public function setTemplatePatch(string $patchToTemplate): self;
    public function stream();
    public function download();
}