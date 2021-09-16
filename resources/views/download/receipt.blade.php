<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>RECEIPT</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td>
									<img src="{{asset('assets/images/brand/logo/cms.png')}}" style="width: 50%; max-width: 100px; mmargin: 0px; padding: 0px;" /><br>
                  <span style="font-size: 11px"> <i> Client Management System </i></span>
								</td>
                
								<td>
									Receipt #: RCP-{{$payment->invoiceSerial}}<br />
									Created: {{Carbon::parse($payment->updated_at)->format('F, d Y')}}<br />
									Payment Date: {{Carbon::parse($payment->paymentDate)->format('F, d Y')}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
									CMS Project, Inc.<br />
									12345 School Road<br />
									Final Project class 
								</td>

								<td>
									{{$payment->client->username}}<br />
									{{$payment->client->fname}}<br />
									{{$payment->client->email}}
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="heading">
					<td>Payment Method</td>

					<td>Amount Paid</td>
				</tr>

				<tr class="details">
					<td>Bank Transfer</td>

					<td>${{$payment->amountToPay}}:00</td>
				</tr>

				<tr class="heading">
					<td>Item</td>

					<td>Price</td>
				</tr>

				<tr class="item last">
					<td>{{$payment->project->title}}</td>

					<td>${{$payment->amountToPay}}:00</td>
				</tr>
				<tr class="total">
					<td></td>

					<td>Total: ${{$payment->amountToPay}}:00</td>
				</tr>
			</table>
		</div>
	</body>
</html>