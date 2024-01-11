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
    color: #464689;
}

.color-yellow {
    color: #d2d245;
}

.color-gray {
    color: #ccc;
}

.color-pink {
    color: #FF00BF;
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

    .contents {
        padding: 8px;
        background-color: #fff;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-right-radius: 8px;
        border-bottom-left-radius: 8px;
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

    .wp-list-table {

        border-spacing: 0;

        input {
            margin: 0;
        }


        th,
        td {
            border-right: solid 1px #e6e6e6;

        }

        th {
            font-weight: bold;
            font-size: 12px;
            white-space: nowrap;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e3e4e6 100%);
            padding: 5px 10px;
        }


        tr {
            &:hover {
                background-color: #e0e0e0;
            }
        }

        td {
            padding: 2px 5px;
            border-bottom: solid 1px #e6e6e6;
            white-space: nowrap;
        }



        .button {
            font-size: 20px;
            line-height: 1;
            padding: 0 3px;
            border: 0;
            width: 28px;
            height: 28px;
            min-height: auto;
            display: grid;
            place-content: center;
            border-radius: 8px;
            background: transparent;
            color: inherit;
            margin: auto;
        }

        .edit-btn {

            background: #e8e8e8;


            &:hover {
                background-color: #fff;
            }
        }

    }

    /* ALL CONTACTS */

    .all-contacts {

        border: solid 1px #ccc;
        border-radius: 6px;



        .scroll {
            overflow: auto;
            padding-bottom: 8px;

            &::-webkit-scrollbar {
                height: 10px;

            }

            &::-webkit-scrollbar-track {
                background: #eee;

            }

            &::-webkit-scrollbar-thumb {
                background: #bbb;
                border-radius: 8px
            }
        }



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

    .pagination {
        padding: 12px;
        text-align: right;

        span,
        a {
            width: 32px;
            height: 32px;
            display: inline-flex;
            background-color: #333;
            justify-content: center;
            align-items: center;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;

            &:hover {
                background-color: #111;
            }
        }

        .current {
            opacity: 0.6;
        }
    }


    .form-category {
        form {}

        .fields {
            display: grid;
            gap: 20px;
            margin-block: 30px;

            .field {
                display: flex;
                align-items: center;
                gap: 8px
            }
        }
    }

    /* add new Contact */
    .add-edit-contact {
        max-width: 1220px;

        h1 {
            margin-bottom: 20px;
        }

        .fields {
            display: grid;
            column-gap: 30px;
            row-gap: 6px;
            grid-template-columns: repeat(auto-fit, minmax(min(225px, 100%), 1fr));

        }

        .field {
            display: flex;
            align-items: center;
            gap: 4px;

            label {
                white-space: nowrap;
                display: flex;
                width: 100%;
                text-align: right;
                justify-content: end;

            }

            select,
            textarea,
            input {
                border: solid 1px #b5b8c8;
                border-radius: 0;
                width: 100%;
                min-width: 148px;
            }
        }

        .large,
        .slogan,
        .note {
            grid-column: span 4 / span 4;
        }

        .textarea {
            textarea {
                width: 100%;
                height: 200px;
            }
        }


    }

    .button {
        display: flex;
        align-items: center;
        gap: 4px;

        svg {
            font-size: 20px;
        }
    }
}
</style>