<?php

///////////////////////////////
// SPED
///////////////////////////////

// Sped Fiscal
$app->get('/sped-fiscal/{filter}', \SpedFiscalController::class . ':gerarSpedFiscal');
$app->get('/sped-contabil/{filter}', \SpedContabilController::class . ':gerarSpedContabil');