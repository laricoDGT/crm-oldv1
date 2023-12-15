<?php
    
    $logo_url = plugins_url('../../assets/images/logo.png', __FILE__);
 
?>

<style>
.color-green {
    color: green;
}

.color-red {
    color: red;
}

.color-orange {
    color: orange;
}

.color-blue {
    color: blue;
}

.color-yellow {
    color: yellow;
}

.crm-wrap {
    border: 1px solid #d0d0d0;
    margin-top: 20px;
    margin-bottom: 50px;
    border-radius: 8px;

    header {
        padding: 4px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(to bottom, #f0f0f0 0%, #d7d7d7 100%);
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;

        .logo {
            font-size: 20px;
            text-shadow: 0px 2px 1px #f2f2f2, 0px 2px 1px #000;
            font-weight: bold;
        }

        .by {
            display: flex;
            align-items: center;

            small {
                font-weight: bold;
            }
        }
    }

    .options {
        background: linear-gradient(to bottom, #e6e6e6 0%, #efefef 100%);
        padding: 6px;
        margin-bottom: 6px;
        border-bottom: solid 1px #ccc;

        ul,
        li {
            margin: 0;
            padding: 0;
        }

        ul {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-size: 14px;

            li.user {
                margin-left: 20px;
            }
        }

        .btn {
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            border: solid 1px transparent;
            background-color: transparent;
            border-radius: 5px;
            padding: 4px 6px;
            text-decoration: none;
            color: inherit;

            svg {
                font-size: 20px;
            }

            &:hover,
            &.current {
                border-color: #9d9d9d;
                background: linear-gradient(to bottom, #fbfbfb 0%, #e9e9e9 100%);
            }
        }
    }

    /* CONTAINER */

    #block-container {
        padding: 8px;
    }

    /* TABS */

    .tabs {
        .tabs-nav {
            margin: 0;
            padding: 0;
        }

        .tabs-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;

            margin-right: 2px;
            margin-bottom: 0;
            padding: 4px 8px;
            border: solid 1px #ccc;
            border-bottom: 0;
            position: relative;

            border-top-right-radius: 4px;
            border-top-left-radius: 4px;
            font-weight: bold;
            font-size: 11px;

            background: linear-gradient(to bottom, #fff 0%, #eaeaea 100%);

            svg {
                font-size: 18px;
            }

            &.current {
                background: linear-gradient(to bottom, #eaeaea 0%, #fff 100%);
                top: 1px;
            }
        }

        .tabs-content {
            background-color: #fff;
            padding: 30px;
            border: solid 1px #ccc;
        }

        .tabs-content:not(.current) {
            display: none;
        }
    }

    /* ALL CONTACTS */

    .all-contacts {
        border: solid 1px #ccc;
        border-radius: 6px;

        .options {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
            border-bottom: 0;
            margin-bottom: 0;
        }

        #new-contact:not(.active) {
            display: none;
        }

        .form {
            background-color: #fff;
            padding: 20px;

            h1 {
                margin: 0;
                padding: 0 0 20px 0;
            }
        }
    }
}

.contents {
    padding: 8px;
    background-color: #fff;
    border-radius: 8px
}
</style>

<div class="wrap">
    <div class="crm-wrap">
        <header>
            <strong class="logo">CRM</strong>
            <div class="by">
                <small>Powered by:</small>
                <img src="<?php echo esc_url($logo_url); ?>" alt="Logo">
            </div>
        </header>
        <div class="options">
            <ul>
                <li>
                    <button class="btn load-block" data-block="settings">
                        <span class="iconify" data-icon="material-symbols:settings"></span>
                        <span>Settings</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block " data-block="all-contacts">
                        <span class="iconify color-green" data-icon="teenyicons:users-solid" data-inline="false"></span>
                        <span>All Contacts</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-orange" data-icon="material-symbols:person-outline-rounded"
                            data-inline="false"></span>
                        <span>Future</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-red" data-icon="material-symbols:person-outline-rounded"
                            data-inline="false"></span>
                        <span>Pipeline</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-yellow" data-icon="material-symbols-light:folder-open"
                            data-inline="false"></span>
                        <span>Attendance</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify color-yellow" data-icon="material-symbols-light:folder-open"
                            data-inline="false"></span>
                        <span>Categories</span>
                    </button>
                </li>
                <li>
                    <button class="btn load-block" data-block="">
                        <span class="iconify" data-icon="fluent:sign-out-24-regular" data-inline="false"></span>
                        <span>Logout</span>
                    </button>
                </li>
                <li class='user'>
                    <span><strong>Welcome:</strong> admin</span>
                </li>
            </ul>
        </div>

        <div class="contents">