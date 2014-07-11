<style type="text/css">
	<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_bootstrap.css') ?>
	tr.unread td {
		font-weight: bold;
	}
	th.from-to {
		width: 50px;
	}
	.messages-nav {
		margin-top: 22px;
	}

	#message-form textarea, #Message_subject {
		width: 325px;
	}
	#message-form label {
		width: 70px;
	}
	#message-form .input {
		margin-left: 80px;
	}
	#message-form .input .errorMessage {
		margin-bottom: 15px;
	}
	.buttons {
		padding-left: 80px;
	}

</style>
