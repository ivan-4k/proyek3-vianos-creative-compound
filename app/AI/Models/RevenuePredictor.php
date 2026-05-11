<?php

namespace App\AI\Models;

use Rubix\ML\Pipeline;
use Rubix\ML\Transformers\ZScaleStandardizer;
use Rubix\ML\Regressors\Ridge;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\PersistentModel;
use Rubix\ML\Persisters\Filesystem;
use Rubix\ML\CrossValidation\Metrics\MeanAbsoluteError;

class RevenuePredictor
{
    private $model;
    private $modelPath;

    public function __construct()
    {
        $dir = storage_path('app/ai-models');
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        $this->modelPath = $dir . '/revenue.model';
    }

    public function train(array $samples, array $labels)
    {
        $pipeline = new Pipeline([
            new ZScaleStandardizer(),
        ], new Ridge(1.0));

        $this->model = new PersistentModel(
            $pipeline,
            new Filesystem($this->modelPath)
        );

        $dataset = new Labeled($samples, $labels);
        $this->model->train($dataset);
        $this->model->save();
        
        // Return MAE on training data
        $predictions = $this->model->predict($dataset);
        $metric = new MeanAbsoluteError();
        return $metric->score($predictions, $labels);
    }

    public function predict(array $features): array
    {
        $this->load();
        $dataset = new Unlabeled($features);
        return $this->model->predict($dataset);
    }

    public function load()
    {
        if (!$this->model) {
            $this->model = PersistentModel::load(new Filesystem($this->modelPath));
        }
    }
    
    public function exists(): bool
    {
        return file_exists($this->modelPath);
    }
}
