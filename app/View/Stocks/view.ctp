


<div class="stocks view">
<h2><?php echo __($stock['Stock']['name']); ?></h2>
<div class="col-xs-12 col-md-6">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('AverageDailyVolume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['averageDailyVolume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Change'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['change']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysHigh'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearLow'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['yearLow']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('YearHigh'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['yearHigh']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('MarketCapitalization'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['marketCapitalization']); ?>
			&nbsp;
		</dd>
		</dl>
		<dl class="right-dl">
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['lastTradePriceOnly'])." ".$stock['StockExchange']['ExchangeRate']['currency']." (".number_format((float)(1/$stock['StockExchange']['ExchangeRate']['rate'])*$stock['Stock']['lastTradePriceOnly'],2,'.',''). " GBP)"; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('DaysRange'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['daysRange']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['symbol']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Volume'); ?></dt>
		<dd>
			<?php echo h($stock['Stock']['volume']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Exchange'); ?></dt>
		<dd>
			<?php echo $stock['StockExchange']['name']; ?>
			&nbsp;
		</dd>
		<?php if($this->Session->read('current_client') != null){ ?>
		<div = "actions">
		<dt><?php echo __('Trade'); ?></dt>
		<dd><?php echo $this->Html->link(__('Buy Stock'), array('controller' => 'client_stocks', 'action' => 'buyStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?>&nbsp;
		
		<?php echo $this->Html->link(__('Sell Stock'), array('controller' => 'client_stocks', 'action' => 'sellStock', $stock['Stock']['id'], $this->Session->read('current_client'))); ?></dd>
		</div>
		<?php } ?>
	</dl>
	</div>
</div>
