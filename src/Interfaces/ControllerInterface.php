<?php
/**
 * @ Этот интерфейсный класс служит для добавления функциональности объекту обрабатывающему ответ клиенту
 * @author Alexander Alekseev
 * @copyright 2021 Noname
 */
declare(strict_types=1);

namespace Work\Interfaces;

interface ControllerInterface
{

    /**
     * @return integer $errorNumber
     */
    public function process(): ResponseInterface;

    /**
     * @parameter array $Request
     * @return void
     */
    public function setRequestParameters(array $request): void;
}
