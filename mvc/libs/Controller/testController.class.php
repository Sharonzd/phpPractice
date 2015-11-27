<?php
class testController{
//	改造前
//	function show(){   //调用模型，并调用视图，将模型产生的数据传递给视图，并让相关视图去显示
//		$testModel = new testModel();   //第二步：选择合适的模型，实例化testModel
//		$data = $testModel -> get();	//使用model取相应的数据
//		$testView = new testView();		//第四步：实例化视图
//		$testView -> display($data);	//使用视图的方法展现数据
//	}

//	改造后
	function show(){   //调用模型，并调用视图，将模型产生的数据传递给视图，并让相关视图去显示
		$testModel = M('test');   //第二步：选择合适的模型，实例化testModel
		$data = $testModel -> get();	//使用model取相应的数据
		$testView = V('test');		//第四步：实例化视图
		$testView -> display($data);	//使用视图的方法展现数据
	}
}
?>