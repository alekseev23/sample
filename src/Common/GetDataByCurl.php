<?php
declare(strict_types=1);

namespace Work\Common;

use Throwable;

/**
 * Получаем данные используя Curl
 * @package Work\Common
 */
class GetDataByCurl
{
    /**
     * @var string Полученные данные
     */
    protected string $data;

    /**
     * @var string Ошибка Curl
     */
    protected string $error;

    /**
     * @param string $url
     * @param int $timeout
     * @return bool
     */
    public function get(string $url, int $timeout): bool
    {
        try {
            $this->error = "";
            // Получаем данные с помощью CURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $s = curl_exec($ch);
            // Ошибка Curl
            if (curl_errno($ch)) {
                $this->error = curl_error($ch);
            }
            curl_close($ch);
            if ($s !== false) {
                $this->data = strval($s);
                return true;
            }
            return false;
        } catch (Throwable $t) { // Если есть проблема, то ругаемся
            $this->error = $t->getMessage();
            return false;
        }
    }

    /**
     * @return string Возвращает загруженные данные
     */
    public function getData(): string
    {
        return $this->data;
    }

    /**
     * @return string звращает описание ошибки если ошибка есть
     */
    public function getError(): string
    {
        return $this->error;
    }
}
