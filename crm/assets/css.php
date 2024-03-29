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
            text-decoration: none;
            color: inherit;
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

            h1 {
                padding-top: 0;
            }
        }

        .tabs-content:not(.current) {
            display: none;
        }

        .options {
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;


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
            padding: 5px 20px 5px 10px;
            cursor: pointer;
            position: relative;



            &:after {
                font-size: 10px;
                position: absolute;
                right: 5px;
                top: 50%;
                transform: translateY(-50%);
            }
        }

        th.ascending::after {
            content: "\25B2";

        }

        th.descending::after {
            content: "\25BC";

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


        .avatar-img {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: block;
            margin: auto;
            transition: all 0.3s ease-in-out;

            &:hover {
                transform: scale(2.5);
            }
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


    .upload-image-btn {
        padding: 0 4px;
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

            ul {
                >li {
                    border-right: solid 1px #d1d1d1;
                    padding-right: 4px;
                }
            }


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
        padding: 30px;

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
                min-width: 126px;
            }



            select,
            textarea,
            input:not([type="checkbox"]):not([type="radio"]) {
                border: solid 1px #b5b8c8;
                border-radius: 0;
                width: 100%;
                min-width: 148px;

                padding: 0 8px;

                min-height: 30px;
            }


        }

        .large,
        .slogan,
        .note,
        .image {
            grid-column: span 4 / span 4;
        }

        .note {
            textarea {
                width: 100%;
                height: 100px;
            }
        }

        .dropdown {
            margin: 0;
            padding: 0;

            li {
                position: relative;
            }

            >li {
                border: solid 1px #b5b8c8;
                border-radius: 0;
                width: 100%;
                min-width: 148px;
                padding: 0 8px;
                min-height: 30px;
                position: relative;
                box-sizing: border-box;
                margin-bottom: 0;

                >a {
                    min-height: 28px;
                    display: grid;
                    align-content: center;
                }


                &:after {
                    content: '';
                    border: solid #9a9a9a;
                    border-width: 0 2px 2px 0;
                    display: inline-flex;
                    padding: 3px;
                    transform: rotate(45deg);
                    right: 8px;
                    position: absolute;
                    top: 7px;
                }

                &:hover {
                    .submenu {
                        opacity: 1;
                        visibility: visible;
                    }
                }
            }

            label {
                justify-content: initial;
                text-align: inherit;
                min-width: auto;
                align-items: center;
            }

            .submenu {
                position: absolute;
                left: 0;
                top: 0%;
                width: 100%;
                background-color: #fff;
                box-shadow: 0 0 6px #00000045;
                padding: 12px;
                max-height: 150px;
                overflow: auto;
                transition: all 0.3s ease-in-out;
                z-index: 3;

                opacity: 0;
                visibility: hidden;

                &::-webkit-scrollbar {
                    width: 10px;
                    height: 10px;
                }

                &::-webkit-scrollbar-track {
                    background: #eee;
                    border-radius: 8px;
                }

                &::-webkit-scrollbar-thumb {
                    background: #333;
                    border-radius: 8px;
                }

            }
        }


    }

    .button {
        display: inline-flex;
        align-items: center;
        gap: 4px;

        svg {
            font-size: 20px;
        }
    }


    .table-footer {

        margin-top: 2px;
        background: linear-gradient(to bottom, #e6e6e6 0%, #efefef 100%);
        border-top: solid 1px #bcb0b0;

        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-inline: 12px;
        padding-block: 6px;
    }
}


/* params  */






/* Importer */
.wp-list-table.importer-table {
    border: solid 1px #ccc;

    tbody {
        td {
            padding: 6px;
        }
    }

}

.importer-form {
    padding: 12px;
    border: solid 1px #ccc;
    max-width: fit-content;
    margin-top: 20px;
    margin-bottom: 50px;
}
</style>