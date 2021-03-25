<?php
$bulan = array (
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
);
?>
<!DOCTYPE html>
<head>
	<script>
	function printNow() {
	    window.print();
	}
	</script>
<title>Invoice</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
html {
    background: white;
    color: black;
    font: 14px 'Helvetica Neue', Arial, sans-serif;
}
body {
    padding: 80px 0 20px;
    margin: 0 auto;
    max-width: 760px;
    width: 100%;
    font-family: "open sans", tahoma, sans-serif;
}
.content {
	text-align:left;
    position: relative;
}
.content .logo{
    text-align: center;
    margin-bottom: 20px;
}
.content .logo img{
    height: 50px;
    width: auto;
    margin: 0 auto;
}
.content .head{
    position: relative;
    margin-bottom: 20px;
}
.content .head:after{
    content: "";
    clear: both;
    display: table;
}
table.toko {
    width: 50%;
    float: left;
}
table.toko th, table.toko td{
    padding: 10px 0;
}
table.customer {
    width: 50%;
    float: left;
}
table.customer th, table.customer td{
    padding: 10px 0;
}
table.items {
	width:100%;
    border: 1px solid #ddd;
    margin-bottom: 10px;
}
table.items th, table.items td {
	padding: 10px;
    border-bottom: 1px solid #ddd;
}

table.detail {
    width: 50%;
    margin-left: 50%;
}
table.detail th, table.detail td{
    padding: 10px 0;
}

table.ttd {
    margin-top: 50px;
    width: 50%;
    margin-left: 50%;
}
table.ttd th, table.ttd td{
    padding: 10px 0;
}
.printnow{
    position: fixed;
    z-index: 999999;
    height: 50px;
    width: 100%;
    left: 0;
    top: 0;
    box-shadow: 0 2px 10px rgba(0,0,0,.09);
    background: #ffffff;
}
.printnow button{
    background: #46CDAC;
    color: #ffffff;
    margin-top: 10px;
    margin-right: 10px;
    line-height: 30px;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    border-radius: 8px;
    border: none;
    float: right;
    width: 100px;
}
</style>
<style type="text/css" media="print">
   .no-print { display: none; }
</style>
</head>
<body>
	<div class="content">
        <div class="logo">
            <?php $get_logo = get_theme_mod('waorder_logo'); ?>
            <img src="<?php echo $get_logo ? $get_logo : get_template_directory_uri() .'/img/logos.png'; ?>">
        </div>
        <div class="head">
            <table class="toko">
                <tr>
                    <td>
                        <strong>Invoice</strong>
                    </td>
                    <td>:</td>
                    <td>
                        <?php echo get_the_title($post->ID); ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>:</td>
                    <td>
                        <?php
                        $m = get_the_date('5', $post->ID);
                        $date = get_the_date('d', $post->ID).' '.$bulan[$m].' '.get_the_date('Y', $post->ID);
                        ?>
                        <?php echo $date; ?>
                    </td>
                </tr>
            </table>
            <table class="customer">
                <tr>
                    <td>
                        <strong><?php echo get_post_meta($post->ID, 'customer_full_name', true); ?></strong><br/>
                        <?php echo get_post_meta($post->ID, 'customer_address', true); ?><br>
                        Phone : <?php echo get_post_meta($post->ID, 'customer_phone', true); ?>
                    </td>
                </tr>
            </table>
        </div>
        <table class="items">
            <thead>
                <tr>
                    <th>Item</th>
                    <th style="text-align:right">Harga (@)</th>
                    <th style="text-align:right">Quantity</th>
                    <th style="text-align:right">SubTotal</th>
                <tr>
            </thead>
            <tbody>
                <?php
                $items = get_post_meta($post->ID, 'order_items', true);
                $items = json_decode($items, true);
                $weight = 0;
                ?>
                <?php foreach( (array)$items as $item):?>
                    <?php
                    $w = intval($item['order_item_weight']) * intval($item['order_item_qty']);
                    $weight = $weight + $w;
                    ?>
                    <tr>
                        <td>
                            <strong><?php echo $item['order_item_name']; ?></strong>
                            <?php if( isset($item['order_item_color']) ): ?>
                                <br>
                                <span>Warna: <?php echo $item['order_item_color']; ?></span>
                            <?php endif; ?>
                            <?php if( isset($item['order_item_custom_name']) && isset($item['order_item_custom_value']) ): ?>
                                <br>
                                <span><?php echo $item['order_item_custom_name']; ?>: <?php echo $item['order_item_custom_value']; ?></span>
                            <?php endif; ?>

                        </td>
                        <td style="text-align:right">
                            <?php echo number_format(intval($item['order_item_price']),0,',',','); ?>
                        </td>
                        <td style="text-align:right">
                            <?php echo $item['order_item_qty']; ?>
                        </td>
                        <td style="text-align:right">
                            <?php
                            $total = intval($item['order_item_price']) * intval($item['order_item_qty']);
                            ?>
                            <?php echo number_format($total,0,'.','.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <table class="detail">
            <tr>
                <td>
                    <strong>Total Berat</strong>
                </td>
                <td>
                    :
                </td>
                <td style="text-align:right">
                    <?php echo $weight ?> Gram
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Pembayaran</strong>
                </td>
                <td>
                    :
                </td>
                <td style="text-align:right">
                    <?php echo get_post_meta($post->ID, 'order_payment_type', true); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Harga Subtotal</strong>
                </td>
                <td>
                    :
                </td>
                <td style="text-align:right">
                    Rp <?php echo number_format(get_post_meta($post->ID, 'order_subtotal', true),0,'.',','); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Ongkir</strong>
                </td>
                <td>
                    :
                </td>
                <td style="text-align:right">
                    <?php echo get_post_meta($post->ID, 'order_ongkir', true); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Total Harga</strong>
                </td>
                <td>
                    :
                </td>
                <td style="text-align:right">
                    <strong>Rp <?php echo number_format(get_post_meta($post->ID, 'order_total', true),0,'.',','); ?></strong>
                </td>
            </tr>
        </table>
        <table class="ttd">
            <tr>
                <td style="text-align:center">
                    <?php
                    $mm = date('5');
                    $dates = date('d').' '.$bulan[$mm].' '.date('Y');
                    ?>
                    _____________ <?php echo $dates; ?>
                </td>
            </tr>
            <tr>
                <td style="text-align:center;padding-top:70px">
                    (............................................)
                </td>
            </tr>
        </table>
	</div>
    <div class="printnow no-print">
        <button type="button" onclick="printNow()">Cetak</button>
    </div>
</body>
</html>
