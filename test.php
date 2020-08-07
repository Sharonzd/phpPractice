<?php
require_once realpath(dirname(__FILE__) . '/../../public/') . '/public.php';
$fis_data = array_merge($publicTestData,
    array(
        'interestUpdateTime' => '2017-10-24',
        'interestRange' => array(
            'updateTime' => '2017-10-24',
            'business' => array(
                'oneYear' => '4.35',
                'twoToFive' => '4.75',
                'moreThanFive' => '4.9'
            ),
            'fund' => array(
                'oneToFive' => '2.75',
                'moreThanFive' => '3.25'
            )
        ),
        'loanPeriod' => array(
            array('text' => '30年（360期）', 'value' => '30'),
            array('text' => '25年（300期）', 'value' => '25'),
            array('text' => '20年（240期）', 'value' => '20'),
            array('text' => '19年（228期）', 'value' => '19'),
            array('text' => '18年（216期）', 'value' => '18'),
            array('text' => '17年（204期）', 'value' => '17'),
            array('text' => '16年（192期）', 'value' => '16'),
            array('text' => '15年（180期）', 'value' => '15'),
            array('text' => '14年（168期）', 'value' => '14'),
            array('text' => '13年（156期）', 'value' => '13'),
            array('text' => '12年（144期）', 'value' => '12'),
            array('text' => '11年（132期）', 'value' => '11'),
            array('text' => '10年（120期）', 'value' => '10'),
            array('text' => '9年（108期）', 'value' => '9'),
            array('text' => '8年（96期）', 'value' => '8'),
            array('text' => '7年（84期）', 'value' => '7'),
            array('text' => '6年（72期）', 'value' => '6'),
            array('text' => '5年（60期）', 'value' => '5'),
            array('text' => '4年（48期）', 'value' => '4'),
            array('text' => '3年（36期）', 'value' => '3'),
            array('text' => '2年（24期）', 'value' => '2'),
            array('text' => '1年（12期）', 'value' => '1')
        ),
        'loanRatio' => array(
            array('text' => '80%', 'value' => '0.8'),
            array('text' => '75%', 'value' => '0.75'),
            array('text' => '70%', 'value' => '0.7'),
            array('text' => '65%', 'value' => '0.65'),
            array('text' => '60%', 'value' => '0.6'),
            array('text' => '55%', 'value' => '0.55'),
            array('text' => '50%', 'value' => '0.5'),
            array('text' => '45%', 'value' => '0.45'),
            array('text' => '40%', 'value' => '0.4'),
            array('text' => '35%', 'value' => '0.35'),
            array('text' => '30%', 'value' => '0.3'),
            array('text' => '25%', 'value' => '0.25'),
            array('text' => '20%', 'value' => '0.2')
        ),
        'businessInterestRate' => 2,
        'fundInterestRate' => 3,
        'businessInterestList' => array(
            array('key' => '基准利率7折',
                'value' => '0.7'
            ), array('key' => '基准利率85折',
                'value' => '0.85'
            ), array('key' => '基准利率88折',
                'value' => '0.88'
            ), array('key' => '基准利率9折',
                'value' => '0.9'
            ), array('key' => '基准利率95折',
                'value' => '0.95'
            ), array('key' => '基准利率',
                'value' => '1'
            ), array('key' => '基准利率1.05倍',
                'value' => '1.05'
            ), array('key' => '基准利率1.1倍',
                'value' => '1.1'
            ), array('key' => '基准利率1.2倍',
                'value' => '1.2'
            ), array('key' => '基准利率1.3倍',
                'value' => '1.3'
            )
        ),
        'fundInterestList' => array(
            array(
                'key' => '公积金基准利率',
                'value' => '1'
            ), array(
                'key' => '公积金基准利率1.1倍',
                'value' => '1.1'
            ), array(
                'key' => '公积金基准利率1.2倍',
                'value' => '1.2'
            ))
    )

);
