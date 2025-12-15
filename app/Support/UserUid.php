<?php

namespace App\Support;

class UserUid
{
    // 自訂 epoch（2024-01-01）
    protected int $epoch = 1704067200000;

    protected int $sequence = 0;
    protected int $lastTimestamp = -1;

    public function generate(): int
    {
        $timestamp = (int) floor(microtime(true) * 1000);

        if ($timestamp === $this->lastTimestamp) {
            $this->sequence++;

            // 同毫秒超過 999 就等下一毫秒
            if ($this->sequence > 999) {
                while (($timestamp = (int) floor(microtime(true) * 1000)) <= $this->lastTimestamp) {
                }
                $this->sequence = 0;
            }
        } else {
            $this->sequence = 0;
        }

        $this->lastTimestamp = $timestamp;

        // 13~16 位數，夠用又好看
        return ((int) ($timestamp - $this->epoch)) * 1000 + $this->sequence;
    }
}
