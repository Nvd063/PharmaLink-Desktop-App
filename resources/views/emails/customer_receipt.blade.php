<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Your Receipt — PharmaLink</title>
    <!--[if mso]>
    <noscript>
        <xml>
            <o:OfficeDocumentSettings>
                <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
        </xml>
    </noscript>
    <![endif]-->
    <style>
        /* Reset for email clients */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; outline: none; text-decoration: none; }
        body { margin: 0 !important; padding: 0 !important; width: 100% !important; }

        /* Responsive */
        @media screen and (max-width: 600px) {
            .email-wrapper { width: 100% !important; }
            .card-inner { padding: 0 !important; }
            .item-name-cell { font-size: 13px !important; }
        }
    </style>
</head>

<!--
    Gmail strips <style> blocks from most emails.
    All critical styles are INLINE to guarantee rendering in Gmail, Outlook, Yahoo, etc.
-->

<body style="margin:0;padding:0;background-color:#f0f2f5;font-family:'Calibri','Segoe UI',Arial,sans-serif;">

<!-- Outer wrapper -->
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
    style="background-color:#f0f2f5;margin:0;padding:0;">
    <tr>
        <td align="center" style="padding:32px 16px 48px;">

            <!-- Card -->
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                style="max-width:480px;width:100%;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.10),0 1px 4px rgba(0,0,0,0.06);">

                <!-- ═══ TOP GREEN STRIPE ═══ -->
                <tr>
                    <td height="4"
                        style="background-color:#10b981;font-size:0;line-height:0;">&nbsp;</td>
                </tr>

                <!-- ═══ HEADER STRIP ═══ -->
                <tr>
                    <td style="background-color:#10b981;padding:10px 24px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:rgba(0,0,0,0.55);">
                                    Official Digital Receipt
                                </td>
                                <td align="right" style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:10px;font-weight:600;color:rgba(0,0,0,0.5);">
                                    {{ $receipt->created_at->format('d M Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ BRAND ROW ═══ -->
                <tr>
                    <td style="padding:20px 24px 16px;border-bottom:1px solid #f0f2f5;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <!-- Logo + Name -->
                                <td>
                                    <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td style="vertical-align:middle;">
                                                <div style="width:32px;height:32px;background-color:#10b981;border-radius:8px;display:inline-block;vertical-align:middle;">
                                                    <table role="presentation" width="32" height="32" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td align="center" valign="middle">
                                                                <!-- Pharmacy icon as unicode/text fallback -->
                                                                <span style="font-size:16px;color:#000;line-height:1;">✚</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                            <td style="padding-left:10px;vertical-align:middle;">
                                                <span style="font-family:Georgia,'Times New Roman',serif;font-size:19px;font-weight:400;color:#0f1115;letter-spacing:-0.5px;">Pharma</span><span style="font-family:Georgia,'Times New Roman',serif;font-size:19px;font-weight:400;color:#10b981;letter-spacing:-0.5px;">Link</span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <!-- Receipt ID pill -->
                                <td align="right" valign="middle">
                                    <span style="display:inline-block;font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:10px;font-weight:600;color:#9ca3af;background-color:#f9fafb;border:1px solid #e5e7eb;border-radius:100px;padding:4px 12px;letter-spacing:0.5px;">
                                        #{{ $receipt->receipt_handle }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ STATUS ROW ═══ -->
                <tr>
                    <td style="background-color:#f9fafb;padding:9px 24px;border-bottom:1px solid #f0f2f5;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;font-weight:600;color:#10b981;">
                                    ● &nbsp;Payment Confirmed
                                </td>
                                <td align="right" style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;color:#9ca3af;">
                                    {{ $receipt->created_at->format('d M Y · h:i A') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ AMOUNT BLOCK ═══ -->
                <tr>
                    <td style="padding:20px 24px;border-bottom:1px solid #f0f2f5;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="background-color:#f0fdf8;border:1px solid #a7f3d0;border-radius:10px;">
                            <tr>
                                <td style="padding:18px 20px;">
                                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tr>
                                            <td>
                                                <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#059669;margin-bottom:6px;">
                                                    Amount Paid
                                                </div>
                                                <div style="font-family:Georgia,'Times New Roman',serif;font-size:34px;font-weight:400;color:#0f1115;letter-spacing:-1px;line-height:1;">
                                                    Rs. {{ number_format($receipt->total_amount, 2) }}
                                                </div>
                                                <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;color:#6b7280;margin-top:5px;">
                                                    {{ $receipt->items->count() }} {{ $receipt->items->count() === 1 ? 'item' : 'items' }} purchased
                                                </div>
                                            </td>
                                            <td align="right" valign="middle">
                                                <span style="display:inline-block;background-color:#dcfce7;border:1px solid #86efac;color:#16a34a;font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;padding:6px 13px;border-radius:100px;">
                                                    ✓ &nbsp;Paid
                                                </span>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ ITEMS HEADER ═══ -->
                <tr>
                    <td style="padding:12px 24px 0;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="border-bottom:1px solid #f0f2f5;padding-bottom:8px;">
                            <tr>
                                <td style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#9ca3af;">
                                    Item
                                </td>
                                <td align="right" style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:#9ca3af;">
                                    Total
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ ITEMS LIST ═══ -->
                @foreach($receipt->items as $item)
                <tr>
                    <td style="padding:0 24px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="border-bottom:1px solid #f9fafb;padding:11px 0;">
                            <tr>
                                <td class="item-name-cell" style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:14px;font-weight:600;color:#1f2937;vertical-align:top;padding-right:12px;">
                                    {{ $item->product->name }}
                                    <div style="font-size:11px;font-weight:400;color:#9ca3af;margin-top:3px;">
                                        {{ $item->quantity }} {{ $item->quantity == 1 ? 'unit' : 'units' }}
                                        &nbsp;·&nbsp;
                                        Rs. {{ number_format($item->price_at_time, 2) }} each
                                    </div>
                                </td>
                                <td align="right" valign="top"
                                    style="font-family:Georgia,'Times New Roman',serif;font-size:15px;color:#374151;white-space:nowrap;letter-spacing:-0.3px;">
                                    Rs. {{ number_format($item->price_at_time * $item->quantity, 2) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                @endforeach

                <!-- ═══ GRAND TOTAL ═══ -->
                <tr>
                    <td style="background-color:#f9fafb;border-top:1px solid #f0f2f5;padding:13px 24px;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#6b7280;">
                                    Grand Total
                                </td>
                                <td align="right"
                                    style="font-family:Georgia,'Times New Roman',serif;font-size:18px;color:#10b981;letter-spacing:-0.5px;font-weight:400;">
                                    Rs. {{ number_format($receipt->total_amount, 2) }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ CUSTOMER INFO ═══ -->
                <tr>
                    <td style="padding:16px 24px;border-top:1px solid #f0f2f5;">
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"
                            style="background-color:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;">
                            <tr>
                                <td width="50%" style="padding:12px 16px;border-right:1px solid #e5e7eb;">
                                    <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#9ca3af;margin-bottom:4px;">
                                        Customer
                                    </div>
                                    <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:13px;font-weight:600;color:#1f2937;">
                                        {{ $receipt->customer->name ?? 'Walk-in Customer' }}
                                    </div>
                                </td>
                                <td width="50%" style="padding:12px 16px;" align="right">
                                    <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:9px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#9ca3af;margin-bottom:4px;">
                                        Phone
                                    </div>
                                    <div style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:13px;font-weight:600;color:#1f2937;">
                                        {{ $receipt->customer->phone ?? '—' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- ═══ FOOTER ═══ -->
                <tr>
                    <td style="padding:16px 24px 22px;border-top:1px solid #f0f2f5;text-align:center;">
                        <p style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;color:#9ca3af;line-height:1.7;margin:0;">
                            This is a computer-generated digital receipt.<br>
                            Thank you for your purchase at <strong style="color:#6b7280;">PharmaLink</strong>.
                        </p>
                        <p style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:11px;font-weight:600;color:#6b7280;margin-top:6px;">
                            {{ $receipt->created_at->format('d M Y  ·  h:i A') }}
                        </p>
                    </td>
                </tr>

                <!-- ═══ BOTTOM GREEN STRIPE ═══ -->
                <tr>
                    <td height="4"
                        style="background-color:#10b981;font-size:0;line-height:0;">&nbsp;</td>
                </tr>

            </table>
            <!-- /Card -->

            <!-- Powered by -->
            <p style="font-family:'Calibri','Segoe UI',Arial,sans-serif;font-size:10px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:#9ca3af;margin-top:20px;text-align:center;">
                Powered by PharmaLink Digital
            </p>

        </td>
    </tr>
</table>

</body>
</html>