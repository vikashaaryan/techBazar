 // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('expanded');
        });

        // Theme toggle
        document.getElementById('theme-toggle').addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');

            // Save preference to localStorage
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Check for saved theme preference
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuButton = document.getElementById('mobile-menu-button');

            if (window.innerWidth < 768 && !sidebar.contains(event.target) && event.target !== mobileMenuButton) {
                sidebar.classList.remove('expanded');
            }
        });

        // Sidebar lock functionality - attached to logo button
        const logoBtn = document.getElementById('logo-btn');
        const lockIndicator = document.getElementById('lock-indicator');
        const sidebar = document.getElementById('sidebar');

        // Check for saved sidebar state
        if (localStorage.getItem('sidebarLocked') === 'true') {
            sidebar.classList.add('locked', 'expanded');
            lockIndicator.classList.remove('hidden');
        }

        logoBtn.addEventListener('click', function (e) {
            // Prevent triggering when clicking on the logo itself (only want the button)
            if (e.target === logoBtn || e.target.closest('#logo-btn')) {
                sidebar.classList.toggle('locked');

                if (sidebar.classList.contains('locked')) {
                    // Lock the sidebar in expanded state
                    sidebar.classList.add('expanded');
                    lockIndicator.classList.remove('hidden');
                    localStorage.setItem('sidebarLocked', 'true');
                } else {
                    // Unlock the sidebar
                    sidebar.classList.remove('expanded');
                    lockIndicator.classList.add('hidden');
                    localStorage.setItem('sidebarLocked', 'false');
                }
            }
        });

        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('click', function () {
                // Toggle active class on the clicked dropdown
                this.classList.toggle('active');

                // Get the corresponding content
                const content = this.nextElementSibling;

                // Toggle the content visibility
                if (content.classList.contains('hidden')) {
                    content.classList.remove('hidden');
                    content.style.maxHeight = content.scrollHeight + 'px';
                } else {
                    content.style.maxHeight = '0';
                    // Wait for transition to complete before adding hidden class
                    setTimeout(() => {
                        content.classList.add('hidden');
                    }, 300);
                }

            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const chartEl = document.getElementById('salesFlowChart');
            const labels = JSON.parse(chartEl.dataset.labels);
            const totals = JSON.parse(chartEl.dataset.totals);

            const ctx = chartEl.getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Sales',
                        data: totals,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => '₹' + value
                            }
                        }
                    }
                }
            });
        });

        function updateChartSizes() {
            const sidebar = document.getElementById('sidebar');
            const charts = document.querySelectorAll('.sidebar-expanded');

            if (sidebar.classList.contains('expanded')) {
                charts.forEach(chart => {
                    chart.classList.add('w-[calc(100%-24rem)]');
                    chart.classList.remove('w-full');
                });
            } else {
                charts.forEach(chart => {
                    chart.classList.remove('w-[calc(100%-24rem)]');
                    chart.classList.add('w-full');
                });
            }
        }

        // Call this when sidebar state changes
        document.getElementById('mobile-menu-button').addEventListener('click', updateChartSizes);
        document.getElementById('logo-btn').addEventListener('click', updateChartSizes);

        // Initialize on load
        window.addEventListener('load', updateChartSizes);