<?php

namespace App\Modules\Order\Tasks;

class CalcBoxSizeTask
{
    private $freeSpace = [];

    public function run(array $items): array
    {
        foreach ($items as $key => $item) {
            if ($key == 0) {
                $length = $item['length'];
                $width = $item['width'];
                $height = $item['height'];

                continue;
            }

            $height = max($item['height'], $height);
            $packedToFreeSpace = $this->attemptPackToFreeSpace($item);

            if (! $packedToFreeSpace) {
                if ($item['length'] < $length) {
                    $lenDiff = $length - $item['length'];
                    $this->freeSpace[] = $this->sortDesc([$lenDiff, $item['width']]);
                }

                $width += $item['width'];
            }
        }

        return [
            'length' => max($length, $width),
            'width' => min($length, $width),
            'height' => $height,
        ];
    }

    private function attemptPackToFreeSpace(array $item): bool
    {
        if (empty($this->freeSpace)) {
            return false;
        }

        $packedToFreeSpace = false;

        foreach ($this->freeSpace as $k => $space) {
            $lengthMatches = $space[0] >= $item['length'];
            $widthMatches = $space[1] >= $item['width'];

            if ($lengthMatches && $widthMatches) {
                $diff = [($space[0] - $item['length']), $space[1]];
                $this->freeSpace[$k] = $this->sortDesc($diff);
                $packedToFreeSpace = true;
                break;
            }
        }

        return $packedToFreeSpace;
    }

    private function sortDesc(array $items): array
    {
        return collect($items)->sortDesc()->values()->all();
    }
}
