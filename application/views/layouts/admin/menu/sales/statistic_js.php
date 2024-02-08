
<script>
    $(document).ready(function () {
        // var csrfData = {};
        // csrfData['<?php echo $this->security->get_csrf_token_name(); ?>'] = '<?php echo $this->security->get_csrf_hash(); ?>';
        // var csrfData = '<?php echo $this->security->get_csrf_hash(); ?>';

        // Auto Set Navigation
        var identity = "<?php echo $identity; ?>";
        var menu_link = "<?php echo $_view; ?>";
        $(".nav-tabs").find('li[class="active"]').removeClass('active');
        $(".nav-tabs").find('li[data-name="statistic"]').addClass('active');

        var url = "<?= base_url('keuangan/manage'); ?>";
        var url_print = "<?= base_url('keuangan/print_operasional'); ?>";
        var url_print_all = "<?= base_url('report/report_operasional'); ?>";
        // $("select").select2();

        $("#start, #end").datepicker({
            // defaultDate: new Date(),
            format: 'dd-mm-yyyy',
            autoclose: true,
            enableOnReadOnly: true,
            language: "id",
            todayHighlight: true,
            weekStart: 1
        }).on('change', function () {
            var start = $("#start").val();
            var end = $("#end").val();
            // chart_one(start,end);
            // chart_two(start,end);
        });

        // 1. Chart Configuration
        var config_chart_one = {
            type: 'pie',
            data: {
                datasets: [
                    {
                        data: [0, 0, 0, 10, 20, 40],
                        backgroundColor: ['#F64971', '#F88D32', '#FBC445', '#F95AEF', '#2D8FE6', '#3FB4B2'],
                    }
                ],
                labels: [
                    'Data 1',
                    'Data 2',
                    'Data 3',
                    'Data 4',
                    'Data 5',
                    'Data 6'
                ]
            },
            options: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Chart One'
                },
                plugins: {
                    labels: {
                        render: 'percentage',
                        fontColor: 'white',
                        fontStyle: 'bold'
                    }
                }
            }
        };
        var config_chart_two = {
            type: 'bar',
            data: {
                datasets: [
                    {
                        label: 'Target',
                        data: [10, 18, 56],
                        backgroundColor: ['#F64971', '#F64971', '#F64971'],
                    }, {
                        label: 'Actual',
                        data: [15, 25, 43],
                        backgroundColor: ['#36A6A3', '#36A6A3', '216160'],
                    }
                ],
                labels: [
                    'Data 1',
                    'Data 2',
                    'Data 3'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,
                },
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    return value.toLocaleString();
                                }
                            }
                        }]
                },
                "hover": {
                    "animationDuration": 0
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function () {
                        var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, null);
                            });
                        });
                    }
                },
                title: {
                    display: true,
                    text: 'Chart Actual & Target'
                }
            }
        };
        var config_chart_three = {
            type: 'bar',
            data: {
                datasets: [
                    {
                        label: 'Target',
                        data: [10, 18, 56],
                        backgroundColor: ['#F64971', '#F64971', '#F64971'],
                    }, {
                        label: 'Actual',
                        data: [15, 25, 43],
                        backgroundColor: ['#36A6A3', '#36A6A3', '216160'],
                    }
                ],
                labels: [
                    'Data 1',
                    'Data 2',
                    'Data 3'
                ]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    display: true,
                },
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    return value.toLocaleString();
                                }
                            }
                        }]
                },
                "hover": {
                    "animationDuration": 0
                },
                "animation": {
                    "duration": 1,
                    "onComplete": function () {
                        var chartInstance = this.chart,
                                ctx = chartInstance.ctx;

                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            var meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                var data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, null);
                            });
                        });
                    }
                },
                title: {
                    display: true,
                    text: 'Chart Actual & Target'
                }
            }
        };

        // 2. Chart Setup
        var id_chart_one = document.getElementById('chart-one').getContext('2d');
        var id_chart_two = document.getElementById('chart-two').getContext('2d');
        var id_chart_three = document.getElementById('chart-three').getContext('2d');

        // 3. Chart Load
        window.chart_one = new Chart(id_chart_one, config_chart_one);
        window.chart_two = new Chart(id_chart_two, config_chart_two);
        window.chart_three = new Chart(id_chart_three, config_chart_three);

        function chart_one(start, end) {
            var prepare = {
                tipe: identity,
                start: start,
                end: end
            };
            var prepare_data = JSON.stringify(prepare);
            var data = {
                action: 'action_name',
                data: prepare_data
            };
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: 'json',
                cache: 'false',
                beforeSend: function () {},
                success: function (d) {
                    if (parseInt(d.status) === 1) {
                        notifSuccess(d.message);
                    } else {
                        notifError(d.message);
                    }
                },
                error: function (xhr, Status, err) {
                    notifError(err);
                }
            });
        }

        function chart_two(start, end) {
            var prepare = {
                tipe: identity,
                start: start,
                end: end
            };
            var prepare_data = JSON.stringify(prepare);
            var data = {
                action: 'action_name',
                data: prepare_data
            };
            $.ajax({
                type: "post",
                url: url,
                data: data,
                dataType: 'json',
                cache: 'false',
                beforeSend: function () {},
                success: function (d) {
                    if (parseInt(d.status) === 1) {
                        notifSuccess(d.message);
                    } else {
                        notifError(d.message);
                    }
                },
                error: function (xhr, Status, err) {
                    notifError(err);
                }
            });
        }

        // chart_one();
        // chart_two();
    });
</script>