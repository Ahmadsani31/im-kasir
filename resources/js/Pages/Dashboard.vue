<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head, usePage } from "@inertiajs/vue3";

const page = usePage();

function sweat() {
  Toast.fire({
    icon: "success",
    title: "Signed in successfully",
  });
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <h5 class="m-b-10">Dashboard</h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item" aria-current="page">Home</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-md-6">
        <div
          class="card bg-secondary-dark dashnum-card text-white overflow-hidden"
        >
          <span class="round small"></span> <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                </div>
              </div>
              <div class="col-auto">
                <div class="btn-group">
                  <a
                    href="#"
                    class="avtar bg-secondary dropdown-toggle arrow-none"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    ><i class="ti ti-dots"></i
                  ></a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item">Import Card</button></li>
                    <li><button class="dropdown-item">Export</button></li>
                  </ul>
                </div>
              </div>
            </div>
            <span class="text-white d-block f-34 f-w-500 my-2"
              >1350 <i class="ti ti-arrow-up-right-circle opacity-50"></i
            ></span>
            <p class="mb-0 opacity-50">Total Pending Orders</p>
            <button @click="sweat">click</button>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-6">
        <div
          class="card bg-primary-dark dashnum-card text-white overflow-hidden"
        >
          <span class="round small"></span> <span class="round big"></span>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="avtar avtar-lg">
                  <i class="text-white ti ti-credit-card"></i>
                </div>
              </div>
              <div class="col-auto">
                <ul
                  class="nav nav-pills justify-content-end mb-0"
                  id="chart-tab-tab"
                  role="tablist"
                >
                  <li class="nav-item" role="presentation">
                    <button
                      class="nav-link text-white active"
                      id="chart-tab-home-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#chart-tab-home"
                      role="tab"
                      aria-controls="chart-tab-home"
                      aria-selected="true"
                    >
                      Month
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button
                      class="nav-link text-white"
                      id="chart-tab-profile-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#chart-tab-profile"
                      role="tab"
                      aria-controls="chart-tab-profile"
                      aria-selected="false"
                      tabindex="-1"
                    >
                      Year
                    </button>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content" id="chart-tab-tabContent">
              <div
                class="tab-pane show active"
                id="chart-tab-home"
                role="tabpanel"
                aria-labelledby="chart-tab-home-tab"
                tabindex="0"
              >
                <div class="row">
                  <div class="col-6">
                    <span class="text-white d-block f-34 f-w-500 my-2"
                      >$1305
                      <i class="ti ti-arrow-up-right-circle opacity-50"></i
                    ></span>
                    <p class="mb-0 opacity-50">Total Earning</p>
                  </div>
                  <div class="col-6">
                    <div id="tab-chart-1" style="min-height: 90px">
                      <div
                        id="apexchartsblfx909x"
                        class="apexcharts-canvas apexchartsblfx909x apexcharts-theme-light"
                        style="width: 212px; height: 90px"
                      >
                        <svg
                          id="SvgjsSvg1643"
                          width="212"
                          height="90"
                          xmlns="http://www.w3.org/2000/svg"
                          version="1.1"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          xmlns:svgjs="http://svgjs.dev"
                          class="apexcharts-svg"
                          xmlns:data="ApexChartsNS"
                          transform="translate(0, 0)"
                          style="background: transparent"
                        >
                          <foreignObject x="0" y="0" width="212" height="90">
                            <div
                              class="apexcharts-legend"
                              xmlns="http://www.w3.org/1999/xhtml"
                              style="max-height: 45px"
                            ></div>
                          </foreignObject>
                          <rect
                            id="SvgjsRect1647"
                            width="0"
                            height="0"
                            x="0"
                            y="0"
                            rx="0"
                            ry="0"
                            opacity="1"
                            stroke-width="0"
                            stroke="none"
                            stroke-dasharray="0"
                            fill="#fefefe"
                          ></rect>
                          <g
                            id="SvgjsG1684"
                            class="apexcharts-yaxis"
                            rel="0"
                            transform="translate(-18, 0)"
                          ></g>
                          <g
                            id="SvgjsG1645"
                            class="apexcharts-inner apexcharts-graphical"
                            transform="translate(0, 1.5)"
                          >
                            <defs id="SvgjsDefs1644">
                              <clipPath id="gridRectMaskblfx909x">
                                <rect
                                  id="SvgjsRect1649"
                                  width="219"
                                  height="103"
                                  x="-5"
                                  y="-8"
                                  rx="0"
                                  ry="0"
                                  opacity="1"
                                  stroke-width="0"
                                  stroke="none"
                                  stroke-dasharray="0"
                                  fill="#fff"
                                ></rect>
                              </clipPath>
                              <clipPath id="forecastMaskblfx909x"></clipPath>
                              <clipPath id="nonForecastMaskblfx909x"></clipPath>
                              <clipPath id="gridRectMarkerMaskblfx909x">
                                <rect
                                  id="SvgjsRect1650"
                                  width="216"
                                  height="91"
                                  x="-2"
                                  y="-2"
                                  rx="0"
                                  ry="0"
                                  opacity="1"
                                  stroke-width="0"
                                  stroke="none"
                                  stroke-dasharray="0"
                                  fill="#fff"
                                ></rect>
                              </clipPath>
                            </defs>
                            <line
                              id="SvgjsLine1648"
                              x1="-0.5"
                              y1="0"
                              x2="-0.5"
                              y2="87"
                              stroke="#b6b6b6"
                              stroke-dasharray="3"
                              stroke-linecap="butt"
                              class="apexcharts-xcrosshairs"
                              x="-0.5"
                              y="0"
                              width="1"
                              height="87"
                              fill="#b1b9c4"
                              filter="none"
                              fill-opacity="0.9"
                              stroke-width="1"
                            ></line>
                            <g id="SvgjsG1656" class="apexcharts-grid">
                              <g
                                id="SvgjsG1657"
                                class="apexcharts-gridlines-horizontal"
                                style="display: none"
                              >
                                <line
                                  id="SvgjsLine1660"
                                  x1="0"
                                  y1="0"
                                  x2="212"
                                  y2="0"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1661"
                                  x1="0"
                                  y1="9.666666666666666"
                                  x2="212"
                                  y2="9.666666666666666"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1662"
                                  x1="0"
                                  y1="19.333333333333332"
                                  x2="212"
                                  y2="19.333333333333332"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1663"
                                  x1="0"
                                  y1="29"
                                  x2="212"
                                  y2="29"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1664"
                                  x1="0"
                                  y1="38.666666666666664"
                                  x2="212"
                                  y2="38.666666666666664"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1665"
                                  x1="0"
                                  y1="48.33333333333333"
                                  x2="212"
                                  y2="48.33333333333333"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1666"
                                  x1="0"
                                  y1="57.99999999999999"
                                  x2="212"
                                  y2="57.99999999999999"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1667"
                                  x1="0"
                                  y1="67.66666666666666"
                                  x2="212"
                                  y2="67.66666666666666"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1668"
                                  x1="0"
                                  y1="77.33333333333333"
                                  x2="212"
                                  y2="77.33333333333333"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                                <line
                                  id="SvgjsLine1669"
                                  x1="0"
                                  y1="87"
                                  x2="212"
                                  y2="87"
                                  stroke="#e0e0e0"
                                  stroke-dasharray="0"
                                  stroke-linecap="butt"
                                  class="apexcharts-gridline"
                                ></line>
                              </g>
                              <g
                                id="SvgjsG1658"
                                class="apexcharts-gridlines-vertical"
                                style="display: none"
                              ></g>
                              <line
                                id="SvgjsLine1671"
                                x1="0"
                                y1="87"
                                x2="212"
                                y2="87"
                                stroke="transparent"
                                stroke-dasharray="0"
                                stroke-linecap="butt"
                              ></line>
                              <line
                                id="SvgjsLine1670"
                                x1="0"
                                y1="1"
                                x2="0"
                                y2="87"
                                stroke="transparent"
                                stroke-dasharray="0"
                                stroke-linecap="butt"
                              ></line>
                            </g>
                            <g
                              id="SvgjsG1659"
                              class="apexcharts-grid-borders"
                              style="display: none"
                            ></g>
                            <g
                              id="SvgjsG1651"
                              class="apexcharts-line-series apexcharts-plot-series"
                            >
                              <g
                                id="SvgjsG1652"
                                class="apexcharts-series"
                                zIndex="0"
                                seriesName="series1"
                                data:longestSeries="true"
                                rel="1"
                                data:realIndex="0"
                              >
                                <path
                                  id="SvgjsPath1655"
                                  d="M 0 48.33333333333333C 10.6 48.33333333333333 19.685714285714283 28.03333333333333 30.285714285714285 28.03333333333333C 40.885714285714286 28.03333333333333 49.97142857142857 52.199999999999996 60.57142857142857 52.199999999999996C 71.17142857142858 52.199999999999996 80.25714285714287 5.799999999999997 90.85714285714286 5.799999999999997C 101.45714285714286 5.799999999999997 110.54285714285714 67.66666666666666 121.14285714285714 67.66666666666666C 131.74285714285713 67.66666666666666 140.82857142857142 49.3 151.42857142857142 49.3C 162.0285714285714 49.3 171.11428571428573 83.13333333333333 181.71428571428572 83.13333333333333C 192.31428571428572 83.13333333333333 201.4 39.63333333333333 212 39.63333333333333"
                                  fill="none"
                                  fill-opacity="1"
                                  stroke="rgba(255,255,255,0.85)"
                                  stroke-opacity="1"
                                  stroke-linecap="butt"
                                  stroke-width="3"
                                  stroke-dasharray="0"
                                  class="apexcharts-line"
                                  index="0"
                                  clip-path="url(#gridRectMaskblfx909x)"
                                  pathTo="M 0 48.33333333333333C 10.6 48.33333333333333 19.685714285714283 28.03333333333333 30.285714285714285 28.03333333333333C 40.885714285714286 28.03333333333333 49.97142857142857 52.199999999999996 60.57142857142857 52.199999999999996C 71.17142857142858 52.199999999999996 80.25714285714287 5.799999999999997 90.85714285714286 5.799999999999997C 101.45714285714286 5.799999999999997 110.54285714285714 67.66666666666666 121.14285714285714 67.66666666666666C 131.74285714285713 67.66666666666666 140.82857142857142 49.3 151.42857142857142 49.3C 162.0285714285714 49.3 171.11428571428573 83.13333333333333 181.71428571428572 83.13333333333333C 192.31428571428572 83.13333333333333 201.4 39.63333333333333 212 39.63333333333333"
                                  pathFrom="M -1 91.83333333333333 L -1 91.83333333333333 L 30.285714285714285 91.83333333333333 L 60.57142857142857 91.83333333333333 L 90.85714285714286 91.83333333333333 L 121.14285714285714 91.83333333333333 L 151.42857142857142 91.83333333333333 L 181.71428571428572 91.83333333333333 L 212 91.83333333333333"
                                  fill-rule="evenodd"
                                ></path>
                                <g
                                  id="SvgjsG1653"
                                  class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown"
                                  data:realIndex="0"
                                >
                                  <g class="apexcharts-series-markers">
                                    <circle
                                      id="SvgjsCircle1688"
                                      r="0"
                                      cx="0"
                                      cy="48.33333333333333"
                                      class="apexcharts-marker wmnenz90a no-pointer-events"
                                      stroke="#ffffff"
                                      fill="#ffffff"
                                      fill-opacity="1"
                                      stroke-width="2"
                                      stroke-opacity="0.9"
                                      default-marker-size="0"
                                    ></circle>
                                  </g>
                                </g>
                              </g>
                              <g
                                id="SvgjsG1654"
                                class="apexcharts-datalabels"
                                data:realIndex="0"
                              ></g>
                            </g>
                            <line
                              id="SvgjsLine1672"
                              x1="0"
                              y1="0"
                              x2="212"
                              y2="0"
                              stroke="#b6b6b6"
                              stroke-dasharray="0"
                              stroke-width="1"
                              stroke-linecap="butt"
                              class="apexcharts-ycrosshairs"
                            ></line>
                            <line
                              id="SvgjsLine1673"
                              x1="0"
                              y1="0"
                              x2="212"
                              y2="0"
                              stroke-dasharray="0"
                              stroke-width="0"
                              stroke-linecap="butt"
                              class="apexcharts-ycrosshairs-hidden"
                            ></line>
                            <g
                              id="SvgjsG1674"
                              class="apexcharts-xaxis"
                              transform="translate(0, 0)"
                            >
                              <g
                                id="SvgjsG1675"
                                class="apexcharts-xaxis-texts-g"
                                transform="translate(0, -4)"
                              ></g>
                            </g>
                            <g
                              id="SvgjsG1685"
                              class="apexcharts-yaxis-annotations"
                            ></g>
                            <g
                              id="SvgjsG1686"
                              class="apexcharts-xaxis-annotations"
                            ></g>
                            <g
                              id="SvgjsG1687"
                              class="apexcharts-point-annotations"
                            ></g>
                          </g>
                        </svg>
                        <div
                          class="apexcharts-tooltip apexcharts-theme-dark"
                          style="left: 11px; top: 51.3333px"
                        >
                          <div
                            class="apexcharts-tooltip-series-group apexcharts-active"
                            style="order: 1; display: flex"
                          >
                            <span
                              class="apexcharts-tooltip-marker"
                              style="
                                background-color: rgb(255, 255, 255);
                                display: none;
                              "
                            ></span>
                            <div
                              class="apexcharts-tooltip-text"
                              style="
                                font-family: Helvetica, Arial, sans-serif;
                                font-size: 12px;
                              "
                            >
                              <div class="apexcharts-tooltip-y-group">
                                <span class="apexcharts-tooltip-text-y-label"
                                  >Total Earning</span
                                ><span class="apexcharts-tooltip-text-y-value"
                                  >45</span
                                >
                              </div>
                              <div class="apexcharts-tooltip-goals-group">
                                <span
                                  class="apexcharts-tooltip-text-goals-label"
                                ></span
                                ><span
                                  class="apexcharts-tooltip-text-goals-value"
                                ></span>
                              </div>
                              <div class="apexcharts-tooltip-z-group">
                                <span
                                  class="apexcharts-tooltip-text-z-label"
                                ></span
                                ><span
                                  class="apexcharts-tooltip-text-z-value"
                                ></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div
                          class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-dark"
                        >
                          <div class="apexcharts-yaxistooltip-text"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="tab-pane"
                id="chart-tab-profile"
                role="tabpanel"
                aria-labelledby="chart-tab-profile-tab"
                tabindex="0"
              >
                <div class="row">
                  <div class="col-6">
                    <span class="text-white d-block f-34 f-w-500 my-2"
                      >$29961
                      <i class="ti ti-arrow-down-right-circle opacity-50"></i
                    ></span>
                    <p class="mb-0 opacity-50">C/W Last Year</p>
                  </div>
                  <div class="col-6">
                    <div id="tab-chart-2" style="min-height: 90px">
                      <div
                        id="apexchartsrz10zc15"
                        class="apexcharts-canvas apexchartsrz10zc15"
                        style="width: 0px; height: 90px"
                      >
                        <svg
                          id="SvgjsSvg1639"
                          width="0"
                          height="90"
                          xmlns="http://www.w3.org/2000/svg"
                          version="1.1"
                          xmlns:xlink="http://www.w3.org/1999/xlink"
                          xmlns:svgjs="http://svgjs.dev"
                          class="apexcharts-svg"
                          xmlns:data="ApexChartsNS"
                          transform="translate(0, 0)"
                          style="background: transparent"
                        >
                          <foreignObject x="0" y="0" width="0" height="90">
                            <div
                              class="apexcharts-legend"
                              xmlns="http://www.w3.org/1999/xhtml"
                            ></div>
                          </foreignObject>
                          <g
                            id="SvgjsG1641"
                            class="apexcharts-inner apexcharts-graphical"
                          >
                            <defs id="SvgjsDefs1640"></defs>
                          </g>
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-12">
        <div
          class="card bg-primary-dark dashnum-card dashnum-card-small text-white overflow-hidden"
        >
          <span class="round bg-primary small"></span>
          <span class="round bg-primary big"></span>
          <div class="card-body p-3">
            <div class="d-flex align-items-center">
              <div class="avtar avtar-lg">
                <i class="text-white ti ti-credit-card"></i>
              </div>
              <div class="ms-2">
                <h4 class="text-white mb-1">
                  $203k <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </h4>
                <p class="mb-0 opacity-50 text-sm">Net Profit</p>
              </div>
            </div>
          </div>
        </div>
        <div class="card dashnum-card dashnum-card-small overflow-hidden">
          <span class="round bg-warning small"></span>
          <span class="round bg-warning big"></span>
          <div class="card-body p-3">
            <div class="d-flex align-items-center">
              <div class="avtar avtar-lg bg-light-warning">
                <i class="text-warning ti ti-credit-card"></i>
              </div>
              <div class="ms-2">
                <h4 class="mb-1">
                  $550K <i class="ti ti-arrow-up-right-circle opacity-50"></i>
                </h4>
                <p class="mb-0 opacity-50 text-sm">Total Revenue</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="basicwizard" class="form-wizard row justify-content-center">
      <div class="col-sm-12 col-md-6 col-xxl-4 text-center">
        <h3>Your Are Loging {{ $page.props.auth.user.name }}</h3>
        <p class="text-muted mb-4">
          A group of people who collectively are responsible for all of the work
          necessary to produce working, validated assets.
        </p>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
