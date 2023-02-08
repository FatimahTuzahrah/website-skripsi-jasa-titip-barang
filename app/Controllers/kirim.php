<?php

namespace App\Controllers;

use PHPUnit\Framework\MockObject\Rule\Parameters;

class Kirim extends BaseController
{

public function Parameters()
{
    const FILE_NAME = 'jastip_malukuutara';
    const Columns = ['item', 'price'];
    const POPULATION_SIZE = 5;
    const BUDGET = 25000;
    const STOPPING_VALUE = 10000;
    const CROSSOVER_RATE = 0.8;
}

class Pengiriman
{
    function createBarangColumn($listOfRawBarang)
    {
        foreach (array_keys($listOfRawBarang) as $listOfRawBarangKey) {
            $listOfRawBarang[Parameters::COLUMNS[$listOfRawBarangKey]] = $listOfRawBarang[$listOfRawBarangKey];
            unset($listOfRawBarang[$listOfRawBarangKey]);
        }
        return $listOfRawBarang;
    }

    function barang()
    {
        $collectionOfListBarang = [];

        $raw_data = file(Parameters::FILE_NAME);
        foreach ($raw_data as $listOfRawBarang) {
            $collectionOfListBarang[] = $this->createBarangColumn(explode(",", $listOfRawBarang));
        }
        return $collectionOfListBarang;
    }
}

class Individu
{
    function countNumberOfGen()
    {
        $deliver = new Deliver;
        return count($deliver->barang());
    }

    function createRandomIndividu()
    {
        for ($i = 0; $i <= $this->countNumberOfGen() - 1; $i++) {
            $ret[] = rand(0, 1);
        }
        return $rat;
    }
}

class Population
{
    function createRandomPopulation()
    {
        for ($i = 0; $i <= Parameters:: POPULATION_SIZE-1; $i++) {
            $ret[] = $individu->createRandomIndividu($parameters);
        }
        return $ret;
    }
}

class Fitness{
    function SelectingItem(){
        $Pengiriman = new Pengiriman;
        foreach($individu as $individuKey => $binaryGen){
            if ($binaryGen === 1){
                $ret[] = [
                    'selectedKey' => $individuKey,
                    'selectedPrice' => $Pengiriman->barang()[$individuKey]['price']
                ];
            }
            return $ret;
        }
    }

    function calculateFitnessValue($individu){
        return array_sum(array_column($this->SelectingItem($individu),'selectedPrice'));
    }

    function countSelectedItem($individu){
        return count($this->SelectingItem($individu));
    }

    function searchBestIndividu($fits, $maxItem, $numberOfIndividuHasMaxItem){
        if ($numberOfIndividuHasMaxItem === 1){
            $index = array_search($maxItem, array_column($fits, 'numberOfSelectedItem'));
            return $fits[$index];
        }else{
            foreach ($fits as $key => $val){
                if ($val['numberOfSelectedItem'] === $maxItem){
                    echo $key.''.$val['fitnessValue'].'<br>';
                    $ret[] = [
                        'individuKey' => $key,
                        'fitnessValue' => $val['fitnessValue']
                    ];
                }
            }
            if (count(array_unique(array_column($ret, 'fitnessValue'))) === 1){
                $index = rand(0, count($ret) - 1);
            }else{
                $max = max(array_column($ret, 'fitnessValue'));
                $index = array_search($max, array_column($ret, 'fitnessValue'));
            }
            echo 'Hasil';
            return $ret[$index];
        }
    }

    function isFound($fits){
       $contedMaxItem = array_count_values(array_column($fits, 'numberOfSelectedItem'));
       print_r($countMaxItem);
       $maxItem = max(array_keys($countMaxItem));
       echo $contedMaxItem[$maxItem];

       $numberOfIndividuHasMaxItem = $contedMaxItem[$maxItem];

       $bestFitnessValue = $this->searchBestIndividu($fits, $maxItem, $numberOfIndividuHasMaxItem)['fitnessValue'];

       $residual = Parameters::BUDGET - $bestFitnessValue;

       if ($residual <= Parameters::STOPPING_VALUE && $residual > 0){
        return TRUE;
       }
    }

    function isFit($fitnessValue){
        if ($fitnessValue <= Parameters::BUDGET){
            return TRUE;
        }
    }

    function FitnessEvaluation($population){
        $pengiriman = new Pengiriman;
        foreach ($population as $listOfIndividuKey => $listOfIndividu){
            // echo 'individu-'. $listOfIndividuKey. '<br>';
            foreach ($listOfIndividu as $individuKey => $binaryGen){
                // echo $binaryGen. '&nbsp;&nbsp;';
            }
            $fitnessValue = $this->calculateFitnessValue($listOfIndividu);
            $numberOfSelectedItem = $this->countSelectedItem($listOfIndividu);
            echo 'Max. Item: '. $numberOfSelectedItem;
            echo ' Fitness Value: '. $fitnessValue;
            if ($this->isFit($fitnessValue)){
                echo '(fit)';
                $fits[] = [
                    'selectedIndividuKey' => $listOfIndividuKey,
                    'numberOfSelectedItem' => $numberOfSelectedItem,
                    'fitnessValue' => $fitnessValue,
                ];
            }else{
                echo '(Not Fit)';
            }
            echo '<p>';
        }
        if ($this->isFound($fits)){
            echo 'Found';
        }else{
            echo '>> Next Generation';
        }
    }
}

class Crossover{
    public $populations;

    function __construct($populations)
    {
        $this->populations = $populations;
    }

    function randomZeroToOne()
    {
        return (float) rand() / (float) getrandmax();
    }

    function generateCrossover()
    {
        for ($i = 0; $i <= Parameters:: POPULATION_SIZE-1; $i++){
            $randomZeroToOne = $this->randomZeroToOne();
            if ($randomZeroToOne < Parameters::CROSSOVER_RATE){
                $parents[$i] = $randomZeroToOne;
            }
        }
        foreach (array_keys($parents) as $key){
            foreach (array_keys($parents) as $subkey){
                if ($key !== $subkey){
                    $ret[] = [$key, $subkey];
                }
            }
            array_shift($key);
        }
    }

    function offspring($parent1, $parent2, $cutPointIndex, $offspring){
        $lengtOfGen = new Individu;
        if ($offspring === 1){
            for ($i = 0; $i <= $lengtOfGen->countNumberOfGen()-1; $i++){
                if ($i <= $cutPointIndex)
                $ret = $parent1[$i];
            }
            if ($i > $cutPointIndex) {
                $ret = $parent2[$i];
            }
        }

        if ($offspring === 2){
            for ($i = 0; $i <= $lengtOfGen->countNumberOfGen()-1; $i++){
                if ($i <= $cutPointIndex)
                $ret = $parent2[$i];
            }
            if ($i > $cutPointIndex) {
                $ret = $parent1[$i];
            }
        }
        return $ret;
    }

    function cutPoinRandom(){
        $lengtOfGen = new Individu;
        return rand(0, $lengtOfGen->countNumberOfGen()-1);
    }

    function crossover()
    {
        $cutPointIndex = $this->cutPoinRandom();
        foreach ($this->generateCrossover() as $listofCrossover){
            $parent1 = $this->populations[$listofCrossover[0]];
            $parent2 = $this->populations[$listofCrossover[1]];
            // echo 'parent :<br>';
            // foreach ($parent1 as $gen){
            //     echo $gen;
            // }
            // echo ' ><';
            // foreach ($parent2 as $gen){
            //     echo $gen;
            // }
            // echo '<br>';

            // echo 'Offspring<br>';
            $offspring1 = $this->offspring($parent1, $parent2, $cutPointIndex, 1);
            $offspring2 = $this->offspring($parent1, $parent2, $cutPointIndex, 2);
            // foreach ($offspring1 as $gen){
            //     echo $gen;
            // }
            // echo ' ><';
            // foreach ($offspring2 as $gen){
            //     echo $gen;
            // }
            // echo '<br>';   
            $offsprings[] = $offspring1;
            $offsprings[] = $offspring2;
        }
        return $offsprings;
    }
}

class Randomizer
{
    static function getRandomIndexOfGen(){
        return rand(0, (new Individu())->countNumberOfGen() -1);
    }

    static function getRandomIndexOfIndividu(){
        return rand(0, Parameters::POPULATION_SIZE - 1);
    }
}

class Mutation
{
    function __construct($population)
    {
        $this->population = $population;
    }

    function calculateMutationRate()
    {
        return 1 / (new Individu())->countNumberOfGen();
    }

    function calculateNumOfMutation()
    {
        return round($this->calculateMutationRate() * Parameters::POPULATION_SIZE);
    }

    function isMutation()
    {
        if ($this->calculateNumOfMutation() > 0){
            return TRUE;
        }
    }

    function generateMutation($valueOfGen)
    {
        if ($valueOfGen === 0){
            return 1;
        }else{
            return 0;
        }
    }

    function mutation()
    {
        if ($this->isMutation()){
            for ($i = 0; $i <= $this->calculateNumOfMutation()-1; $i++){
                $indexOfIndividu = Randomizer::getRandomIndexOfIndividu();
                $indexOfGen = Randomizer::getRandomIndexOfGen();
                $selectedIndividu = $this->population[$indexOfIndividu];

                echo 'Before Mutation: ';
                print_r($selectedIndividu);
                echo '<br>';
                $valueOfGen = $selectedIndividu[$indexOfGen];
                $mutatedGen = $this->generateMutation($valueOfGen);
                echo 'After Mutation: ';
                print_r($selectedIndividu);
                $selectedIndividu[$indexOfGen] = $mutatedGen;
                $ret[] = $selectedIndividu;
            }
            return $ret;
        }
       
    }
}

class Selection
{
    function __construct($population, $combinedoffsprings)
    {
        $this->population = $population;
        $this->combinedoffsprings = $combinedoffsprings;
    }

    function createTemporaryPopulation()
    {
        foreach ($this->combinedoffsprings as $offspring){
            $this->population[] = $offspring;
        }
        return $this->population;
    }

    function getVariableValue($basePopulation, $fitTemporaryPopulation)
    {
        foreach ($fitTemporaryPopulation as $val){
            $ret[] = $basePopulation[$val[1]];
        }
        return $ret;
    }

    function sortFitTemporaryPopulation()
    {
        $tempPopulation = $this->createTemporaryPopulation();
        $fitness = new Fitness;
        foreach ($tempPopulation as $key => $individu){
            $fitnessValue = $fitness->calculateFitnessValue($individu);
            if ($fitness->isfit($fitnessValue)){
                $fitTemporaryPopulation[] = [
                    $fitnessValue,
                    $key,
                ];
            }
        }
        rsort($fitTemporaryPopulation);
        $fitTemporaryPopulation = array_slice($fitTemporaryPopulation, 0, Parameters::POPULATION_SIZE);
        return $this->getVariableValue($tempPopulation, $fitTemporaryPopulation);
    }

    function selectingIndividus(){
        $selected = $this->sortFitTemporaryPopulation();
    }
}
}

$parameters = [
    'file_name' => 'barang.txt',
    'columns' => ['item', 'price'],
    'population_size' => 10
];

$pengiriman = new Pengiriman;
$pengiriman->barang($parameters);

$intialPopulation = new Population;
$intialPopulation->createRandomPopulation();

$fitness = new Fitness;
$fitness->FitnessEvaluation($intialPopulation);

$crossover = new Crossover($population);
$crossoveroffsprings = $crossover->crossover();

// (new Mutation($population))->mutation();
$mutation = new Mutation($population);
if ($mutation->mutation()){
    $mutationoffsprings = $mutation->mutation();

    foreach ($mutationoffsprings as $mutationoffspring){
        $crossoveroffsprings[] = $mutationoffspring;
    }
}

$selection = new Selection($population, $crossoveroffsprings);


// $individu = new Individu;
// $individu->createRandomIndividu();
