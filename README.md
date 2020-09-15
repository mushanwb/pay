##  支付

简介：适用于支付宝和微信支付。支付宝支付是通过下载支付宝的 SDK ，
并且对接 SDK 代码用于支付，使用的是支付宝 app 2.0 接口
微信支付是通过 easywechat 的扩展包进行对接。

## 开始
执行 
```php
    composer install
```
安装 laravel 的拓展包以及 easywechat


### 支付思路：

Ⅰ、通过调用 payCenterController 控制器的 payCenter 进行支付。传入支付必须参数。

```php
//  restful api

[post]    /api/pay_center
```

> 支付统一必传参数：   
> payment : 支付方式    
> order_num : 订单号   
> total_price : 订单总价格(单位：元)  
> goods_title : 商品标题 (body)   
> detail : 商品详情 (微信的 detail 参数，支付宝的 subject 参数) 

> 注意：微信支付还必须传 openid 和 trade_type , trade_type 值为 JSAPI 或 APP 两种选择

Ⅱ、两个支付方式分别实现了 Pay 这个接口，因此如需要添加其他支付方式，也必须实现该接口。

Ⅲ、在 payFactory 控制器中通过 payment 参数来获取支付对象，如需添加其他的支付方式，    
应该在这里添加相应支付对象

Ⅳ、微信和支付宝都有默认的配置文件，如需要添加其他支付方式，则应该在添加该有的配置文件。

Ⅵ、每一个支付方式，都应该需要处理传过来的下单参数，通过客户端的参数来筛选最后的下单参数。


