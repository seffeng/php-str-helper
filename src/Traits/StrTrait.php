<?php
/**
 * @link http://github.com/seffeng/
 * @copyright Copyright (c) 2022 seffeng
 */
namespace Seffeng\StrHelper\Traits;

/**
 *
 * @author zxf
 * @date   2020年6月10日
 */
Trait StrTrait
{
    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  integer $length
     * @param  bool $diff   区分大小写
     * @return string
     */
    public static function generateChatCode(int $length, bool $diff = false)
    {
        $letters = 'bcdfghjklmnpqrstvwxyz';
        $letterUpper = 'BCDFGHJKLMNPQRSTVWXYZ';
        $vowels = 'aeiou';
        $vowelUpper = 'AEIOU';

        if ($diff) {
            $letters .= $letterUpper;
            $vowels .= $vowelUpper;
        }

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  integer $length
     * @return string
     */
    public static function generateNumberCode(int $length)
    {
        $letters = '24680';
        $vowels = '13579';

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  integer $length
     * @param  bool $diff   区分大小写
     * @return string
     */
    public static function generateStringCode(int $length, bool $diff = false)
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $letterUpper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $vowels = '1234567890';

        $diff && $letters .= $letterUpper;

        return self::generateAlgorithm($letters, $vowels, $length);
    }

    /**
     *
     * @author zxf
     * @date   2020年4月30日
     * @param  integer $length
     * @return string
     */
    public static function generateAlgorithm(string $letters, string $vowels, int $length)
    {
        $vowelsLength = strlen($vowels) - 1;
        $lettersLength = strlen($letters) - 1;
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $vowels[mt_rand(0, $vowelsLength)];
            } else {
                $code .= $letters[mt_rand(0, $lettersLength)];
            }
        }

        return $code;
    }

    /**
     * Safely casts a float to string independent of the current locale.
     *
     * The decimal separator will always be `.`.
     * @param float|integer $number a floating point number or integer.
     * @return string the string representation of the number.
     */
    public static function floatToString($number)
    {
        // . and , are the only decimal separators known in ICU data,
        // so its safe to call str_replace here
        return str_replace(',', '.', strval($number));
    }

    /**
     * Returns the trailing name component of a path.
     * This method is similar to the php function `basename()` except that it will
     * treat both \ and / as directory separators, independent of the operating system.
     * This method was mainly created to work on php namespaces. When working with real
     * file paths, php's `basename()` should work fine for you.
     * Note: this method is not aware of the actual filesystem, or path components such as "..".
     *
     * @param string $path A path string.
     * @param string $suffix If the name component ends in suffix this will also be cut off.
     * @return string the trailing name component of the given path.
     */
    public static function basename($path, $suffix = '')
    {
        if (($len = mb_strlen($suffix)) > 0 && mb_substr($path, -$len) === $suffix) {
            $path = mb_substr($path, 0, -$len);
        }
        $path = rtrim(str_replace('\\', '/', $path), '/\\');
        if (($pos = mb_strrpos($path, '/')) !== false) {
            return mb_substr($path, $pos + 1);
        }

        return $path;
    }

    /**
     * 字符串转数组
     * @author zxf
     * @date   2021年11月18日
     * @param string $value
     * @param string $delimiter
     * @param mixed $replace
     * @return array
     */
    public static function toArray(string $value, string $delimiter, $replace = null)
    {
        $replace && $value = str_replace($replace, '', $value);
        $value = trim($value, $delimiter);

        if (strpos($value, $delimiter) !== false) {
            $items = array_filter(array_unique(explode($delimiter, $value)));
        } elseif ($value) {
            $items = [$value];
        } else {
            $items = [];
        }
        return $items;
    }

    /**
     *
     * @author zxf
     * @date   2023-12-18
     * @param string $string
     * @param array|null $search
     * @param string $replace
     * @return integer
     */
    public static function wordLength(string $string, array $search = null, string $replace = '')
    {
        if (is_null($search)) {
            $search = [
                '&nbsp;', '~', '`', '·', '!', '！', '@', '#', '￥', '$', '%', '^', '…', '&', '*', '(', ')', '（', '）', '-',
                '—', '=', '+', '{', '}', '[', ']', '\\', '|', '、', '；', ':', '：', '‘', '’', '“', '”', ' ', '"', ',', '，',
                '<', '>', '《','》', '.', '。', '？', '?', '/', '、'
            ];
        }
        return mb_strlen(str_replace($search, $replace, strip_tags(htmlspecialchars_decode($string))));
    }
}
