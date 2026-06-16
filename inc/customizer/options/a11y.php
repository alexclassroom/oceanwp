<?php
/**
 * OceanWP Customizer Settings: Accessibility - A11Y
 *
 * @package OceanWP WordPress theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = [

	'ocean_accessibility_mode' => [
		'type'              => 'ocean-switch',
		'label'             => esc_html__( 'Enable Accessibility Mode', 'oceanwp' ),
		'section'           => 'ocean_accessibility',
		'default'           => ocean_accessibility_get_default_value(),
		'transport'         => 'refresh',
		'priority'          => 10,
		'sanitize_callback' => 'oceanwp_sanitize_checkbox',
	],

	'ocean_accessibility_main_header_tags' => [
		'type'              => 'ocean-switch',
		'label'             => esc_html__( 'Enable Main Header Tags', 'oceanwp' ),
		'section'           => 'ocean_accessibility',
		'default'           => ocean_accessibility_get_default_value(),
		'transport'         => 'refresh',
		'priority'          => 10,
		'sanitize_callback' => 'oceanwp_sanitize_checkbox',
	],

    'ocean_spacer_for_a11y_search_section' => [
		'type' => 'ocean-spacer',
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'top' => 1,
		'bottom' => 1,
	],

	'ocean_accessibility_search_section' => [
		'type' => 'section',
		'title' => esc_html__( 'Search Forms', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'after' => 'ocean_spacer_for_a11y_search_section',
		'class' => 'section-a11y',
		'priority' => 10,
		'options' => [
			 'ocean_accessibility_header_search_tags' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Enable Semantic Header Search', 'oceanwp' ),
				'section'           => 'ocean_accessibility_search_section',
				'default'           => ocean_accessibility_get_default_value(),
				'transport'         => 'refresh',
				'priority'          => 10,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'ocean_display_header_search_form_label' => [
                'type'              => 'ocean-switch',
                'label'             => esc_html__( 'Display Header Search Label', 'oceanwp' ),
                'section'           => 'ocean_accessibility_search_section',
                'default'           => ocean_accessibility_get_default_value(),
                'transport'         => 'refresh',
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'oceanwp_sanitize_checkbox'
            ],

			'ocean_custom_header_search_form_label' => [
				'label'             => esc_html__( 'Header Search Form Label', 'oceanwp' ),
				'type'              => 'ocean-text',
				'section'           => 'ocean_accessibility_search_section',
				'transport'         => 'postMessage',
				'default'           => esc_html__( 'Search this website', 'oceanwp' ),
				'priority'          => 10,
				'hideLabel'         => false,
				'sanitize_callback' => 'wp_filter_nohtml_kses',
				'active_callback'   => 'ocean_cac_display_search_form_label'
			],

			'ocean_custom_header_search_form_label_size' => [
				'label'     => esc_html__( 'Label Size', 'oceanwp' ),
				'type'      => 'ocean-range-slider',
				'section'   => 'ocean_accessibility_search_section',
				'transport' => 'postMessage',
				'priority'  => 10,
				'hideLabel'    => false,
				'isUnit'       => true,
				'isResponsive' => true,
				'min'          => 10,
				'max'          => 30,
				'step'         => 1,
				'active_callback'   => 'ocean_cac_display_search_form_label',
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args' => [
					'desktop' => [
						'id' => 'ocean_custom_header_search_form_label_size',
						'label' => esc_html__( 'Desktop', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'tablet' => [
						'id' => 'ocean_custom_header_search_form_label_size_tablet',
						'label' => esc_html__( 'Tablet', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id' => 'ocean_custom_header_search_form_label_size_mobile',
						'label' => esc_html__( 'Mobile', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'unit' => [
						'id' => 'ocean_custom_header_search_form_label_size_unit',
						'label' => esc_html__( 'Unit', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
							'default' => 'px',
						],
					],
				],
				'preview' => 'queryWithType',
				'css' => [
					'.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-dropdown-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label' => ['font-size']
				]
			],

			'ocean_custom_header_search_form_label_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Label Color', 'oceanwp' ),
				'section' => 'ocean_accessibility_search_section',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'    => 'ocean_cac_display_search_form_label',
				'setting_args' => [
					'normal' => [
						'id' => 'ocean_custom_header_search_form_label_color',
						'key' => 'normal',
						'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
						'selector' => [
							'.header-search-visible-label,.medium-header-search-visible-label,.vertical-header-search-visible-label,.mobile-dropdown-search-visible-label,.mobile-fs-search-visible-label,.oceanwp-mobile-menu-search-visible-label' => 'color',
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '',
						]
					],
				]
			],


        ]
    ],

	 'ocean_spacer_for_a11y_comment_form_section' => [
		'type' => 'ocean-spacer',
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'top' => 1,
		'bottom' => 1,
	],

	'ocean_accessibility_comment_form_section' => [
		'type' => 'section',
		'title' => esc_html__( 'Comment Form', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'after' => 'ocean_spacer_for_a11y_comment_form_section',
		'class' => 'section-a11y',
		'priority' => 10,
		'options' => [
			'ocean_display_comment_form_label' => [
                'type'              => 'ocean-switch',
                'label'             => esc_html__( 'Display Comment Form Label', 'oceanwp' ),
                'section'           => 'ocean_accessibility_comment_form_section',
                'default'           => ocean_accessibility_get_default_value(),
                'transport'         => 'refresh',
                'priority'          => 10,
                'hideLabel'         => false,
                'sanitize_callback' => 'oceanwp_sanitize_checkbox'
            ],

			'ocean_comment_form_label_size' => [
				'label'     => esc_html__( 'Label Size', 'oceanwp' ),
				'type'      => 'ocean-range-slider',
				'section'   => 'ocean_accessibility_comment_form_section',
				'transport' => 'postMessage',
				'priority'  => 10,
				'hideLabel'    => false,
				'isUnit'       => true,
				'isResponsive' => true,
				'min'          => 10,
				'max'          => 30,
				'step'         => 1,
				'active_callback'   => 'ocean_cac_display_comment_form_label',
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args' => [
					'desktop' => [
						'id' => 'ocean_comment_form_label_size',
						'label' => esc_html__( 'Desktop', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'tablet' => [
						'id' => 'ocean_comment_form_label_size_tablet',
						'label' => esc_html__( 'Tablet', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id' => 'ocean_comment_form_label_size_mobile',
						'label' => esc_html__( 'Mobile', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'unit' => [
						'id' => 'ocean_comment_form_label_size_unit',
						'label' => esc_html__( 'Unit', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
							'default' => 'px',
						],
					],
				],
				'preview' => 'queryWithType',
				'css' => [
					'.comment-form-visible-label' => ['font-size']
				]
			],

			'ocean_comment_form_label_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Label Color', 'oceanwp' ),
				'section' => 'ocean_accessibility_comment_form_section',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'    => 'ocean_cac_display_comment_form_label',
				'setting_args' => [
					'normal' => [
						'id' => 'ocean_comment_form_label_color',
						'key' => 'normal',
						'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
						'selector' => [
							'.comment-form-visible-label' => 'color',
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '',
						]
					],
				]
			],

			'ocean_comment_form_label_ie_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Label Color', 'oceanwp' ),
				'section' => 'ocean_accessibility_comment_form_section',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'sanitize_callback' => 'wp_kses_post',
				'active_callback'    => 'ocean_cac_display_comment_form_label',
				'setting_args' => [
					'normal' => [
						'id' => 'ocean_comment_form_label_ie_color',
						'key' => 'normal',
						'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
						'selector' => [
							'.comment-form-visible-label span' => 'color',
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '',
						]
					],
				]
			],


        ]
    ],

	'ocean_accessibility_mobile_header_tags' => [
		'type'              => 'ocean-switch',
		'label'             => esc_html__( 'Enable Mobile Header Tags', 'oceanwp' ),
		'section'           => 'ocean_accessibility',
		'default'           => ocean_accessibility_get_default_value(),
		'transport'         => 'refresh',
		'priority'          => 10,
		'sanitize_callback' => 'oceanwp_sanitize_checkbox',
	],

	'ocean_display_header_video_controls' => [
		'type'              => 'ocean-switch',
		'label'             => esc_html__( 'Display Header Video Control Buttons', 'oceanwp' ),
		'section'           => 'ocean_accessibility',
		'default'           => ocean_accessibility_get_default_value(),
		'transport'         => 'postMessage',
		'priority'          => 10,
		'hideLabel'         => false,
		'sanitize_callback' => 'oceanwp_sanitize_checkbox',
        'active_callback'    => 'oceanwp_cac_has_header_video',
	],

    'ocean_header_video_button_background_color' => [
		'type' => 'ocean-color',
		'label' => esc_html__( 'Button Background Color', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'hideLabel' => false,
		'showAlpha' => true,
		'showPalette' => true,
		'sanitize_callback' => 'wp_kses_post',
        'active_callback' => 'oceanwp_cac_header_video_controls',
		'setting_args' => [
			'normal' => [
				'id' => 'ocean_header_video_button_background_color',
				'key' => 'normal',
				'label' => esc_html__( 'Normal', 'oceanwp' ),
				'selector' => [
                    '#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button' => 'background-color',
                ],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
			'hover' => [
				'id' => 'ocean_header_video_button_background_color_hover',
				'key' => 'hover',
				'label' => esc_html__( 'Hover', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:hover' => 'background-color',
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
           'focus' => [
				'id' => 'ocean_header_video_button_background_color_focus',
				'key' => 'focus',
				'label' => esc_html__( 'Focus', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:focus' => 'background-color'
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
		]

	],

    'ocean_header_video_button_icon_color' => [
		'type' => 'ocean-color',
		'label' => esc_html__( 'Button Icon Color', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'transport' => 'refresh',
		'priority' => 10,
		'hideLabel' => false,
		'showAlpha' => true,
		'showPalette' => true,
		'sanitize_callback' => 'wp_kses_post',
        'active_callback' => 'oceanwp_cac_header_video_controls',
		'setting_args' => [
			'normal' => [
				'id' => 'ocean_header_video_button_icon_color',
				'key' => 'normal',
				'label' => esc_html__( 'Normal', 'oceanwp' ),
				'selector' => [
                    '#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button' => 'color',
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
			'hover' => [
				'id' => 'ocean_header_video_button_icon_color_hover',
				'key' => 'hover',
				'label' => esc_html__( 'Hover', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:hover' => 'color',
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
           'focus' => [
				'id' => 'ocean_header_video_button_icon_color_focus',
				'key' => 'focus',
				'label' => esc_html__( 'Focus', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:focus' => 'color'
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
		]

	],

    'ocean_header_video_button_border_color' => [
		'type' => 'ocean-color',
		'label' => esc_html__( 'Button Border Color', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'hideLabel' => false,
		'showAlpha' => true,
		'showPalette' => true,
		'sanitize_callback' => 'wp_kses_post',
        'active_callback' => 'oceanwp_cac_header_video_controls',
		'setting_args' => [
			'normal' => [
				'id' => 'ocean_header_video_button_border_color',
				'key' => 'normal',
				'label' => esc_html__( 'Normal', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button' => 'border-color',
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
			'hover' => [
				'id' => 'ocean_header_video_button_border_color_hover',
				'key' => 'hover',
				'label' => esc_html__( 'Hover', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:hover' => 'border-color',
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
           'focus' => [
				'id' => 'ocean_header_video_button_border_color_focus',
				'key' => 'focus',
				'label' => esc_html__( 'Focus', 'oceanwp' ),
				'selector' => [
					'#site-header .custom-header-media.has-video-controls .wp-custom-header-video-button:focus' => 'border-color'
				],
				'attr' => [
					'transport' => 'postMessage',
					'default'   => '',
				],
			],
		]

	],

    'ocean_header_video_background_overlay' => [
		'type' => 'ocean-color',
		'label' => esc_html__( 'Video Background Overlay', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'hideLabel' => false,
		'showAlpha' => true,
		'showPalette' => true,
		'sanitize_callback' => 'wp_kses_post',
        'active_callback'    => 'oceanwp_cac_has_header_video',
		'setting_args' => [
			'normal' => [
				'id' => 'ocean_header_video_background_overlay',
				'key' => 'normal',
				'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
				'selector' => [
                    '#site-header.has-header-media .overlay-header-media.has-video' => 'background-color',
                    '#site-header.has-header-media .overlay-header-media.has-video-image' => 'background-color'
                ],
                'attr' => [
                    'transport' => 'postMessage',
                    'default'   => 'rgba(0,0,0,0.3)',
                ]
			],
		]
	],

	'ocean_spacer_for_main_header_social_menu_section' => [
		'type' => 'ocean-spacer',
		'section' => 'ocean_accessibility',
		'transport' => 'postMessage',
		'priority' => 10,
		'top' => 1,
		'bottom' => 1,
	],

	'ocean_main_header_social_menu_section' => [
		'type' => 'section',
		'title' => esc_html__( 'Main Header Social Menu', 'oceanwp' ),
		'section' => 'ocean_accessibility',
		'after' => 'ocean_spacer_for_main_header_social_menu_section',
		'class' => 'section-a11y-header-social-menu',
		'priority' => 10,
		'options' => [
			'ocean_display_social_external_icon' => [
				'type'              => 'ocean-switch',
				'label'             => esc_html__( 'Display Social External Icon', 'oceanwp' ),
				'section'           => 'ocean_main_header_social_menu_section',
				'default'           => false,
				'transport'         => 'refresh',
				'priority'          => 10,
				'sanitize_callback' => 'oceanwp_sanitize_checkbox',
			],

			'ocean_header_social_external_icon_size' => [
				'label'     => esc_html__( 'Responsive Icon Size (em)', 'oceanwp' ),
				'type'      => 'ocean-range-slider',
				'section'   => 'ocean_main_header_social_menu_section',
				'transport' => 'postMessage',
				'priority'  => 10,
				'hideLabel'    => false,
				'isUnit'       => false,
				'isResponsive' => true,
				'min'          => 0.5,
				'max'          => 1,
				'step'         => 0.05,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args' => [
					'desktop' => [
						'id' => 'ocean_header_social_external_icon_size',
						'label' => esc_html__( 'Desktop', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
							'default'   => 0.72
						],
					],
					'tablet' => [
						'id' => 'ocean_header_social_external_icon_size_tablet',
						'label' => esc_html__( 'Tablet', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					],
					'mobile' => [
						'id' => 'ocean_a11y_header_social_external_icon_size_mobile',
						'label' => esc_html__( 'Mobile', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
						],
					]
				],
				'preview' => 'queryWithType',
				'css' => [
					'.header-social-menu-external-mark' => ['width'],
					'.header-social-menu-external-mark' => ['height']
				]
			],

			'ocean_header_social_external_icon_x_offset' => [
				'label'     => esc_html__( 'Horizontal offset (em)', 'oceanwp' ),
				'type'      => 'ocean-range-slider',
				'section'   => 'ocean_main_header_social_menu_section',
				'transport' => 'postMessage',
				'priority'  => 10,
				'hideLabel'    => false,
				'isUnit'       => false,
				'isResponsive' => false,
				'min'          => -0.6,
				'max'          => 0.6,
				'step'         => 0.05,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args' => [
					'desktop' => [
						'id' => 'ocean_header_social_external_icon_x_offset',
						'label' => esc_html__( 'Desktop', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
							'default'   => -0.15
						],
					]
				],
				'preview' => 'queryWithType',
				'css' => [
					'.header-social-menu-external-mark' => ['padding-left'],
					'.header-social-menu-external-mark' => ['padding-right']
				]
			],

			'ocean_header_social_external_icon_y_offset' => [
				'label'     => esc_html__( 'Vertical offset (em)', 'oceanwp' ),
				'type'      => 'ocean-range-slider',
				'section'   => 'ocean_main_header_social_menu_section',
				'transport' => 'postMessage',
				'priority'  => 10,
				'hideLabel'    => false,
				'isUnit'       => false,
				'isResponsive' => false,
				'min'          => -0.6,
				'max'          => 0.6,
				'step'         => 0.05,
				'sanitize_callback' => 'oceanwp_sanitize_number_blank',
				'setting_args' => [
					'desktop' => [
						'id' => 'ocean_header_social_external_icon_y_offset',
						'label' => esc_html__( 'Desktop', 'oceanwp' ),
						'attr' => [
							'transport' => 'postMessage',
							'default'   => -0.25
						],
					]
				],
				'preview' => 'queryWithType',
				'css' => [
					'.header-social-menu-external-mark' => ['padding-top'],
					'.header-social-menu-external-mark' => ['padding-bottom']
				]
			],

			'ocean_header_social_external_icon_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Icon Color', 'oceanwp' ),
				'section' => 'ocean_main_header_social_menu_section',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args' => [
					'normal' => [
						'id' => 'ocean_header_social_external_icon_color',
						'key' => 'normal',
						'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
						'selector' => [
							'.header-social-menu-external-mark' => 'color',
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '#ffffff',
						]
					],
				]
			],

			'ocean_header_social_external_icon_background_color' => [
				'type' => 'ocean-color',
				'label' => esc_html__( 'Background Color', 'oceanwp' ),
				'section' => 'ocean_main_header_social_menu_section',
				'transport' => 'postMessage',
				'priority' => 10,
				'hideLabel' => false,
				'showAlpha' => true,
				'showPalette' => true,
				'sanitize_callback' => 'wp_kses_post',
				'setting_args' => [
					'normal' => [
						'id' => 'ocean_header_social_external_icon_background_color',
						'key' => 'normal',
						'label' =>  esc_html__( 'Select Color', 'oceanwp' ),
						'selector' => [
							'.header-social-menu-external-mark' => 'background-color',
						],
						'attr' => [
							'transport' => 'postMessage',
							'default'   => '#000000',
						]
					],
				]
			],

		]
	]
];
