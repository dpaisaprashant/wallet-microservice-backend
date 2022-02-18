<?php


namespace App\Wallet\Excel;


use App\Models\TransactionEvent;
use App\Wallet\Excel\Interfaces\IExportExcel;
use Box\Spout\Writer\Style\StyleBuilder;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportExcelHelper implements IExportExcel
{
    private $name;

    private $resource; //Resource class

    private $request;

    private $generatorModel; //Eloquent Model

    private $mixGeneratorModels;


    /**
     * @param mixed $name
     * @return ExportExcelHelper
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $resource
     * @return ExportExcelHelper
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        return $this;
    }

    /**
     * @param mixed $generatorModel
     * @return ExportExcelHelper
     */
    public function setGeneratorModel($generatorModel)
    {
        $this->generatorModel = $generatorModel;
        return $this;
    }

    /**
     * @param mixed $request
     * @return ExportExcelHelper
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @param array $mixGeneratorModels
     * @return ExportExcelHelper
     */
    public function setMixGeneratorModels($mixGeneratorModels)
    {
        $this->mixGeneratorModels = $mixGeneratorModels;
        return $this;
    }

    private function headerStyle()
    {
        return (new StyleBuilder())
            ->setFontBold()
            /*->setBackgroundColor(Color::ORANGE)*/
            ->build();
    }

    private function excelName($name)
    {
        return $name. '-' .now().'.xlsx';
    }

    private function generatorCollection()
    {
        if ($this->generatorModel == TransactionEvent::class) {
            foreach ($this->generatorModel::latest()->doesntHave('refundTransaction')->filter($this->request)->cursor() as $model) {
                yield $model;
            }
        } else {
            foreach ($this->generatorModel::latest()->filter($this->request)->cursor() as $model) {
                yield $model;
            }
        }
    }

    private function mixGeneratorCollection()
    {
        foreach ($this->mixGeneratorModels as $model) {
            yield $model;
        }
    }

    public function exportExcel()
    {
        return (new FastExcel($this->generatorCollection()))->headerStyle($this->headerStyle())->download($this->excelName($this->name), function ($value) {
            return (new $this->resource($value));
        });
    }

    public function exportExcelCollection()
    {
        return (new FastExcel($this->mixGeneratorCollection()))->headerStyle($this->headerStyle())->download($this->excelName($this->name));
    }




}
