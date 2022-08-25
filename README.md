## PHP Helpers

### 安装

```shell
# 安装
$ composer require seffeng/str-helper
```

### 目录说明

```
|---src
|   |   Str.php
|   |---Traits
|           StrTrait.php
|---tests
|       StrTest.php
```

### 示例

```php
/**
 * TestController.php
 * 示例
 */
namespace App\Http\Controllers;

use Seffeng\StrHelper\Str;

class TestController extends Controller
{
    public function index()
    {
        var_dump(Str::generateChatCode(6));

        $value = 'a,342 , c,  def,';
        print_r(Str::toArray($value, ',', ' '));
    }
}
```

### 备注

1、更多示例请参考 tests 目录下测试文件。