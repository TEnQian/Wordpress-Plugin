<?php
namespace Elementor;
function my_taxonomy()
{
    $terms = get_terms([
        "taxonomy" => "category",
        "hide_empty" => true,
    ]);
    $options = [];
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

function my_product()
{
    $terms = get_terms([
        "taxonomy" => "product_cat",
        "hide_empty" => true,
    ]);
    $options = [];
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

function custom_next_page($paged)
{
    $next;
    if ($paged < 1) {
        $next = 2;
    } else {
        $next = $paged + 1;
    }
    return $next;
}

function custom_prev_page($paged)
{
    $prev;
    if ($paged < 1) {
        $prev = 0;
    } else {
        $prev = $paged - 1;
    }
    return $prev;
}
class My_Widget_3 extends Widget_Base
{
    public function get_name()
    {
        return "myrepeater";
    }

    public function get_title()
    {
        return "My Repeater1";
    }

    public function get_icon()
    {
        return "eicon-code";
    }

    public function get_categories()
    {
        return ["basic"];
    }

    public function on_import($element)
    {
        if (
            isset($element["settings"]["posts_post_type"]) &&
            !get_post_type_object($element["settings"]["posts_post_type"])
        ) {
            $element["settings"]["posts_post_type"] = "post";
        }

        return $element;
        echo $element;
    }

    protected function register_controls()
    {
        $this->start_controls_section("content_section", [
            "label" => esc_html__("Content", "plugin-name"),
            "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $repeater = new Repeater();
        $mr = new Repeater();

        $field_types = [
            "posttitle" => esc_html__("Post Title", "plugin-name"),
            "postcontent" => esc_html__("Post Content", "plugin-name"),
            "postimage" => esc_html__("Post Image", "plugin-name"),
            "acffield" => esc_html__("ACF Field", "plugin-name"),
            "date" => esc_html__("Date", "plugin-name"),
            "author" => esc_html__("Author", "plugin-name"),
        ];

        $repeater->add_control("field_type", [
            "label" => esc_html__("Type", "plugin-name"),
            "type" => Controls_Manager::SELECT,
            "options" => $field_types,

            "default" => "postcontent",
        ]);

        $repeater->add_control("acfdata", [
            "label" => esc_html__("ACF Field Key", "plugin-name"),
            "type" => Controls_Manager::TEXT,
            "default" => "",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => ["acffield"],
                    ],
                ],
            ],
        ]);

        $repeater->add_control("title-alignment", [
            "label" => esc_html__("Post Title Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "label_block" => true,
            "separator" => "after",
            "default" => "left",
            "options" => [
                "left" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-title " => "text-align: {{VALUE}}",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => ["posttitle"],
                    ],
                ],
            ],
        ]);

        $repeater->add_responsive_control("post-content-alignment", [
            "label" => esc_html__("Post Content Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "label_block" => true,
            "separator" => "after",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => ["postcontent"],
                    ],
                ],
            ],

            "options" => [
                "left" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-content" => "text-align: {{VALUE}};",
            ],
        ]);

        $repeater->add_responsive_control("post-title-color", [
            "label" => esc_html__("Post Title Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .post-title" => "color: {{VALUE}}",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "posttitle",
                    ],
                ],
            ],
        ]);

        $repeater->add_responsive_control("post-date-alignment", [
            "label" => esc_html__("Post Date Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "label_block" => true,
            "separator" => "after",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => ["date"],
                    ],
                ],
            ],

            "options" => [
                "left" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-date" => "text-align: {{VALUE}};",
            ],
        ]);

        $repeater->add_responsive_control("post-date-color", [
            "label" => esc_html__("Post Date Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .post-date" => "color: {{VALUE}}",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "date",
                    ],
                ],
            ],
        ]);

        $repeater->add_responsive_control("post-author-alignment", [
            "label" => esc_html__("Post Author Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "label_block" => true,
            "separator" => "after",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => ["author"],
                    ],
                ],
            ],

            "options" => [
                "left" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-author" => "text-align: {{VALUE}};",
            ],
        ]);

        $repeater->add_responsive_control("post-author-color", [
            "label" => esc_html__("Post Author Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .post-author" => "color: {{VALUE}}",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "author",
                    ],
                ],
            ],
        ]);

        $repeater->add_responsive_control("imagewidth", [
            "label" => esc_html__("Image Width", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px", "%"],
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 1140,
                    "step" => 1,
                ],
                "%" => [
                    "min" => 0,
                    "max" => 100,
                    "step" => 1,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-image" => "width: {{SIZE}}{{UNIT}};",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "postimage",
                    ],
                ],
            ],
        ]);
        $repeater->add_responsive_control("imageheight", [
            "label" => esc_html__("Image Height", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px", "%"],
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 1140,
                    "step" => 1,
                ],
                "%" => [
                    "min" => 0,
                    "max" => 100,
                    "step" => 1,
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .post-image" => "height: {{SIZE}}{{UNIT}};",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "postimage",
                    ],
                ],
            ],
        ]);

        $repeater->add_responsive_control("imagefit", [
            "label" => esc_html__("Image Fit", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SELECT,
            "options" => [
                "contain" => esc_html__("Contain", "plugin-name"),
                "cover" => esc_html__("Cover", "plugin-name"),
                "fill" => esc_html__("Fill", "plugin-name"),
                "none" => esc_html__("None", "plugin-name"),
                "scale-down" => esc_html__("Scale Down", "plugin-name"),
            ],
            "default" => "cover",
            "selectors" => [
                "{{WRAPPER}} .post-image" => "object-fit: {{VALUE}};",
            ],
            "conditions" => [
                "terms" => [
                    [
                        "name" => "field_type",
                        "operator" => "in",
                        "value" => "postimage",
                    ],
                ],
            ],
        ]);

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                "name" => "post_content_typography",
                "label" => esc_html__("Post Title Typography", "plugin-name"),
                "selector" => "{{WRAPPER}} .post-title",
                "conditions" => [
                    "terms" => [
                        [
                            "name" => "field_type",
                            "operator" => "in",
                            "value" => ["posttitle"],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                "name" => "post_date_typography",
                "label" => esc_html__("Post Date Typography", "plugin-name"),
                "selector" => "{{WRAPPER}} .post-date",
                "conditions" => [
                    "terms" => [
                        [
                            "name" => "field_type",
                            "operator" => "in",
                            "value" => ["date"],
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                "name" => "post_author_typography",
                "label" => esc_html__("Post Author Typography", "plugin-name"),
                "selector" => "{{WRAPPER}} .post-author",
                "conditions" => [
                    "terms" => [
                        [
                            "name" => "field_type",
                            "operator" => "in",
                            "value" => ["author"],
                        ],
                    ],
                ],
            ]
        );

        $this->add_control("repeater1", [
            "label" => esc_html__("Repeater List", "plugin-name"),
            "type" => \Elementor\Controls_Manager::REPEATER,
            "fields" => $repeater->get_controls(),
        ]);

        $this->add_control("post_per_page", [
            "label" => esc_html__("Post Per Page", "plugin-name"),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "default" => 6,
        ]);

        $this->add_control("read_more", [
            "label" => esc_html__("Enable Read More?", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "your-plugin"),
            "label_off" => esc_html__("No", "your-plugin"),
            "return_value" => "yes",
            "default" => "yes",
        ]);

        $this->add_control("pagination", [
            "label" => esc_html__("Enable Pagination?", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SWITCHER,
            "label_on" => esc_html__("Yes", "your-plugin"),
            "label_off" => esc_html__("No", "your-plugin"),
            "return_value" => "yes",
            "default" => "yes",
        ]);

        $this->add_responsive_control("colnum", [
            "label" => esc_html__("Column", "plugin-name"),
            "type" => \Elementor\Controls_Manager::NUMBER,
            "default" => 3,
            "selectors" => [
                "{{WRAPPER}} .mainrepeater" =>
                    "grid-template-columns: repeat({{VALUE}},1fr);",
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section("query_section", [
            "label" => esc_html__("Query", "plugin-name"),
            "tab" => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $queryType = [
            "post" => esc_html__("Post", "plugin-name"),
            "product" => esc_html__("Product", "plugin-name"),
            "current" => esc_html__("Current Query", "plugin-name"),
        ];

        $this->add_control("querySource", [
            "label" => esc_html__("Source", "plugin-name"),
            "type" => Controls_Manager::SELECT,
            "options" => $queryType,

            "default" => "",
        ]);

        $this->add_control("post_query", [
            "label" => esc_html__("Post Categories", "plugin-name"),
            "type" => Controls_Manager::SELECT2,
            "options" => my_taxonomy(),
            "multiple" => true,
            "default" => "",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "querySource",
                        "operator" => "in",
                        "value" => ["post"],
                    ],
                ],
            ],
        ]);

        $this->add_control("notin", [
            "label" => esc_html__("Exclude Categories", "plugin-name"),
            "type" => Controls_Manager::SELECT2,
            "options" => my_taxonomy(),
            "multiple" => true,
            "default" => "",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "querySource",
                        "operator" => "in",
                        "value" => ["post"],
                    ],
                ],
            ],
        ]);

        $this->add_control("product_query", [
            "label" => esc_html__("Product Categories", "plugin-name"),
            "type" => Controls_Manager::SELECT2,
            "options" => my_product(),
            // 'multiple' => true,
            "default" => "",
            "conditions" => [
                "terms" => [
                    [
                        "name" => "querySource",
                        "operator" => "in",
                        "value" => ["product"],
                    ],
                ],
            ],
        ]);

        $orderfield = [
            "desc" => esc_html__("Desc", "plugin-name"),
            "asc" => esc_html__("Asc", "plugin-name"),
        ];

        $this->add_control("order_type", [
            "label" => esc_html__("Order", "plugin-name"),
            "type" => Controls_Manager::SELECT,
            "options" => $orderfield,
            "default" => "desc",
        ]);

        $orderby_field = [
            "none" => esc_html__("None", "plugin-name"),
            "ID" => esc_html__("ID", "plugin-name"),
            "date" => esc_html__("Date", "plugin-name"),
            "name" => esc_html__("Name", "plugin-name"),
            "title" => esc_html__("Title", "plugin-name"),
            "comment_count" => esc_html__("Comment count", "plugin-name"),
            "rand" => esc_html__("Random", "plugin-name"),
        ];

        $this->add_control("orderby_type", [
            "label" => esc_html__("Order By", "plugin-name"),
            "type" => Controls_Manager::SELECT,
            "options" => $orderby_field,
            "default" => "desc",
        ]);

        $this->end_controls_section();

        $this->start_controls_section("Column style", [
            "label" => esc_html__("Column", "plugin-name"),
            "tab" => \Elementor\Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control("colgap", [
            "label" => esc_html__("Column Gap", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px"],
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 100,
                    "step" => 1,
                ],
            ],
            "default" => [
                "unit" => "px",
                "size" => 10,
            ],
            "selectors" => [
                "{{WRAPPER}} .mainrepeater" => "grid-gap: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("rowgap", [
            "label" => esc_html__("Row Gap", "plugin-name"),
            "type" => \Elementor\Controls_Manager::SLIDER,
            "size_units" => ["px"],
            "range" => [
                "px" => [
                    "min" => 0,
                    "max" => 100,
                    "step" => 1,
                ],
            ],
            "default" => [
                "unit" => "px",
                "size" => 10,
            ],
            "selectors" => [
                "{{WRAPPER}} .mainrepeater" => "row-gap: {{SIZE}}{{UNIT}};",
            ],
        ]);

        $this->add_control("post-background-color", [
            "label" => esc_html__("Post Background Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#fff",
            "selectors" => [
                "{{WRAPPER}} .repeateritem" => "background-color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("post_padding", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Content Padding", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .repeateritem" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("title_padding", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Title Padding", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .post-title" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("title_margin", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Title Margin", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .post-title" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("content_padding", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Post Content Padding", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .post-content" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("content_margin", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Post Content Margin", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .post-content" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                "name" => "read_more_typography",
                "label" => esc_html__("Read More Typography", "plugin-name"),
                "selector" => "{{WRAPPER}} .read-more",
            ]
        );

        $this->add_responsive_control("read-more-color", [
            "label" => esc_html__("Read More Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .read-more-link" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("read-more-hover-color", [
            "label" => esc_html__("Read More Hover Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .read-more-link:hover" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_control("read-more-alignment", [
            "label" => esc_html__("Read More Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "separator" => "after",
            "options" => [
                "left" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "right" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .read-more" => "text-align: {{VALUE}}",
            ],
        ]);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                "name" => "pagination_typography",
                "label" => esc_html__("Pagination Typography", "plugin-name"),
                "selector" => "{{WRAPPER}} .the-pagination",
            ]
        );

        $this->add_responsive_control("pagination-color", [
            "label" => esc_html__("Pagination Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#7c2529",
            "selectors" => [
                "{{WRAPPER}} .the-pagination" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("pagination-hover-color", [
            "label" => esc_html__("Pagination Hover Color", "plugin-name"),
            "type" => \Elementor\Controls_Manager::COLOR,
            "default" => "#ffc0cb",
            "selectors" => [
                "{{WRAPPER}} .the-pagination:hover" => "color: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("pagination-alignment", [
            "label" => esc_html__("Pagination Alignment", "elementor"),
            "type" => Controls_Manager::CHOOSE,
            "separator" => "after",
            "options" => [
                "flex-start" => [
                    "title" => __("Left", "elementor"),
                    "icon" => "eicon-text-align-left",
                ],
                "center" => [
                    "title" => __("Center", "elementor"),
                    "icon" => "eicon-text-align-center",
                ],
                "flex-end" => [
                    "title" => __("Right", "elementor"),
                    "icon" => "eicon-text-align-right",
                ],
            ],
            "selectors" => [
                "{{WRAPPER}} .navigation-link" => "justify-content: {{VALUE}}",
            ],
        ]);

        $this->add_responsive_control("pagination_padding", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Pagination Padding", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .the-pagination" =>
                    "padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->add_responsive_control("pagination_margin", [
            "type" => \Elementor\Controls_Manager::DIMENSIONS,
            "label" => esc_html__("Paginationt Margin", "plugin-name"),
            "size_units" => ["px", "em", "%"],
            "selectors" => [
                "{{WRAPPER}} .the-pagination" =>
                    "margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};",
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        require_once "GetCount.php";
        $settings = $this->get_settings_for_display();
        $post_per_page = $settings["post_per_page"];
        $field_type = $item["field_type"];
        $post_type = $settings["querySource"];
        $paged = max(0, get_query_var("paged"), get_query_var("page"));
        $next_link = get_permalink() . "" . custom_next_page($paged);
        $prev_link = get_permalink() . "" . custom_prev_page($paged);
        $next_page = custom_next_page($paged) - 2;
        $prev_page = custom_prev_page($paged) + 2;
        if ($paged == 0) {
            $paged = 0;
        } else {
            $paged = $next_page;
        }
        $postOffset = $paged * $post_per_page;
        ?>
        <style>
            .navigation-link{
                display: flex;
                justify-content:center;
                margin-top:30px;
            }
            
            .the-pagination{
                margin-left:5px;
                margin-right:5px;
            }
            
            .prev-page, .next-page{
                color:inherit;
            }
            
            .prev-page:hover, .next-page:hover{
                color:inherit;
            }
        </style>
        <?php
        if ($post_type == "post") {
            $pquery = [];
            $pid = [];
            $category_exclude = [];
            $category_id = [];
            foreach ($settings["post_query"] as $key => $value) {
                $pquery[$key] = $value;
                $pid[$key] = get_cat_ID($pquery[$key]);
            }
            foreach ($settings["notin"] as $key => $value) {
                $category_exclue[$key] = $value;
                $category_id[$key] = get_cat_ID($category_exclue[$key]);
            }
            $args = [
                "post_type" => $post_type,
                "taxonomy" => "category",
                "category" => $pid,
                "category__not_in" => $category_id,
                "numberposts" => -1,
                "posts_per_page" => $post_per_page,
                "order" => $settings["order_type"],
                "orderby" => $settings["orderby_type"],
                "offset" => $postOffset,
            ];
        } 
        else if ($post_type == "product") {
            $pquery = $settings["product_query"];
            $args = [
                "post_type" => $post_type,
                "taxonomy" => "product_cat",
                "product_cat" => $pquery,
                "numberposts" => -1,
                "posts_per_page" => $post_per_page,
                "order" => $settings["order_type"],
                "orderby" => $settings["orderby_type"],
                "offset" => $postOffset,
            ];
        } 
        else if ($post_type == "current") {
            $current_post_id = get_the_ID();
            $current_post_type = get_post_type($current_post_id);
            $current_category;
            if ($current_post_type == "post") {
                $current_category = get_the_category($current_post_id)[0]->name;
            }
            $args = [
                "post_type" => $current_post_type,
                "taxonomy" => "category",
                "category_name" => $current_category,
                "numberposts" => -1,
                "posts_per_page" => $post_per_page,
                "order" => $settings["order_type"],
                "orderby" => $settings["orderby_type"],
                "offset" => $postOffset,
            ];
        }

        $my_posts = get_posts($args);
        $countPost = getCount($args);
        $max = $countPost / $post_per_page;
        $max = ceil($max);
        if (custom_next_page($paged) > $max) {
            $next_link = get_permalink();
        }

        if (custom_prev_page($paged) == 0) {
            $prev_link = get_permalink() . "" . $max;
        }
        if (!empty($my_posts)) {
            echo '<div class="mainrepeater" style="display:grid;">';
            foreach ($my_posts as $p) {
                $postid = $p->ID;
                $url = get_the_post_thumbnail_url($postid);
                //'<a href='. get_permalink( $p->ID ).' target="_blank">'. '<div class="post-title" >'.$p->post_title.'</div></a>'
                $posttitle = '<h1 class="post-title" >' . $p->post_title . "</h1>";
                $postcontent = '<div class="post-content" >' . $p->post_content . "</div>";
                $postimage = '<img class="post-image"  src=' . $url . "></img>";
                $postdate = '<div class="post-date">' . $p->post_date . "</div>";
                $postauthor = '<div class="post-date" >'.get_the_author_meta("display_name", $p->post_author)."</div>";
                if ($settings["repeater1"]) {
                    echo '<div class="repeateritem">';
                    foreach ($settings["repeater1"] as $item) {
                        $myacf = $item["acfdata"];
                        $choose = $item["field_type"];
                        $myfield = get_field($myacf, $p->ID);
                        $acf = '<div class="myacf">' . $myfield . "</div> ";

                        if ($choose == "posttitle") {
                            echo $posttitle;
                        } 
			else if ($choose == "postcontent") {
                            echo $postcontent;
                        }
			else if ($choose == "postimage") {
                            echo $postimage;
                        }
			else if ($choose == "acffield") {
                            echo $acf;
                        }
			else if ($choose == "date") {
                            echo $postdate;
                        }
			else if ($choose == "author") {
                            echo $postauthor;
                        }
                    }

                    if ("yes" === $settings["read_more"]) {
                        echo '<div  class="read-more"><a class="read-more-link" href="'.get_permalink($p->ID).'">Read More</a></div>';
                    }
                    echo "</div>";
                }
            }
            echo "</div>";
            if ("yes" === $settings["pagination"]) {
                echo '<div class="navigation-link"><div class="the-pagination"><a class="prev-page" href="'.$prev_link.'">Prev</a></div>';
                for ($i = 1; $i <= $max; $i++) {
                    echo '<a class="the-pagination-numbers the-pagination" href="'.get_permalink()."".$i.'">'.$i."</a>";
                }
                echo '<div class="the-pagination"><a class="next-page" href="'.$next_link.'">Next</a></div></div>';
            }
        }
    }
}
