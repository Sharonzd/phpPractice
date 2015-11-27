{include file="header.tpl" sitename="啦啦网"}
{*引入文件，file指定文件路径  自定义的属性可以被参数传递给eader.tpl当作变量识别并使用  如果传递的变量在header.tpl中有同名的，则会被此参数覆盖*}

{*变量*}
{$articletitle}  //相当于php的echo
{*数组*}
{$arr['title']}
{$arr['author']}
{$arr.title}
{$arr.author}

{*二维数组*}
{$arr2['articlecontent']['title']}
{$arr2['articlecontent']['author']}

{*调节器*}
{$articletitle|capitalize}  {*所有单词的首字母都会大写*}
{$articletitle|cat:" yesterday"}
{$time|date_format}  {* 默认显示月 日，年Mar 16,2014*}
{$time|date_format:"%H:%M:%S"}  {*显示未设定时区的时间08:33:23*}
{$time|date_format:"%B %e, %Y"}   {*Mar 16,2014*}
{$articletitle|default:"no title"}   {*空或者未指定的时候都是no title*}
{$url|escape:"url"}   {*转码，指明转码方式*}
{$articletitle|lower}   {*转化为小写*}
{$articletitle|upper}   {*转化为大写*}
{$articlecontent|nl2br}  {*将换行符转化为html的换行标签br*}

{*条件判断*}
{if $score gt 90}
    优秀
{elseif $score gt 60}
    及格
{else}
    不及格
{/if}

{*section循环  name为id号，loop为需要循环的变量*}
{section name=article loop=$articlelist}
    {$articlelist[article].title}
    {$articlelist[article].author}
    {$articlelist[article].content}
    <br />
    {sectionelse}   {*循环不出来东西的时候显示的内容*}
    当前分类下没有文章
{/section}

{*foreach循环 item为每一项  articlelist为要循环的变量*}
{foreach item=article from=$articlelist}
    {$article.title}
    {$article.author}
    {$article.content}
    <br/>
    {foreachelse}   {*循环不出来东西的时候显示的内容*}
    当前分类下没有文章
{/foreach}

{*smarty3支持的循环方式，原生的php方式*}
{foreach $articlelist as $article}
    {$article.title}
    {$article.author}
    {$article.content}
    <br/>
    {foreachelse}   {*循环不出来东西的时候显示的内容*}
    当前分类下没有文章
{/foreach}

{$myobj->methl(array('苹果','熟了'))}   {*调用对象的方法*}

{*使用php内置函数*}
{$time}   {*显示当前时间戳*}
{"Y-m-d"|date:$time}   {*直接用调节器执行内置函数,但是第一个参数是时间格式，第二个参数是时间戳*}

{'d'|str_replace:'h':$str}  {*将d替换为h*}

{*函数名称f_name  参数*}
{f_test p1='abc' p2='edf'}
{block}

{/block}