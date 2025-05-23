<?php
function custom_shortcode($atts) {
    $atts = shortcode_atts(['type' => 'contact'], $atts);

    $shortcodes = [
        'contact' => [
            [
                'label' => 'Phone:',
                'value' => '(02) 8811-0278',
                'description' => 'Customer Care Hotline'
            ],
            [
                'label' => 'Mobile:',
                'value' => '0998-5919006',
                'description' => 'Customer Care Mobile number'
            ],
            [
                'label' => 'Email:',
                'value' => 'usb-camu@ucpbsavings.com',
                'description' => 'Customer Care Email'
            ],
            [
                'label' => 'Facebook:',
                'value' => 'www.facebook.com/UCPBS.KASAMAMO',
                'description' => 'Official Facebook Page of UCPB Savings Bank'
            ]
        ],
        'support' => [
            [
                'label' => 'Support Hotline:',
                'value' => '1800-1234-5678',
                'description' => '24/7 Customer Support'
            ],
            [
                'label' => 'Support Email:',
                'value' => 'support@ucpbsavings.com',
                'description' => 'Technical Support Email'
            ]
        ]
    ];

    $info = $shortcodes[$atts['type']] ?? $shortcodes['contact'];

    ob_start(); ?>

    <div class="contact-info">
        <?php foreach ($info as $item) : ?>
            <div class="contact-item">
            <div class="label">
                <strong><?php echo esc_html($item['label']); ?></strong>
        </div>
                <div class="value">
                <span><?php echo esc_html($item['value']); ?></span>
                <small><?php echo esc_html($item['description']); ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php return ob_get_clean();
}

add_shortcode('custom_shortcode', 'custom_shortcode'); ?>

<style>
    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .contact-item {
        display: flex;
        flex-wrap:wrap;
        padding: 10px 0;
        border-bottom: 1px solid #ccc;
    }
    .contact-item .label{
        flex:1;
    }
    .contact-item .value{
        flex:3;
    }

    .contact-item:last-child {
        border-bottom: none;
    }

    .contact-item strong {
        font-weight: bold;
    }

    .contact-item span {
        font-size: 16px;
        margin:0;
        display: block;
    }

    .contact-item small {
        color: #666;
        font-size: 12px;
    }
</style>