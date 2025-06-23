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

                // Close other open dropdowns if needed (for accordion behavior)
                // document.querySelectorAll('.dropdown-content').forEach(otherContent => {
                //     if (otherContent !== content && !otherContent.classList.contains('hidden')) {
                //         otherContent.style.maxHeight = '0';
                //         otherContent.classList.add('hidden');
                //         otherContent.previousElementSibling.classList.remove('active');
                //     }
                // });
            });
        });

        // Optional: Hover functionality (uncomment if you want hover instead of click)
        /*
        document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
            toggle.addEventListener('mouseenter', function() {
                this.classList.add('active');
                const content = this.nextElementSibling;
                content.classList.remove('hidden');
                content.style.maxHeight = content.scrollHeight + 'px';
            });
            
            toggle.parentElement.addEventListener('mouseleave', function() {
                const toggle = this.querySelector('.dropdown-toggle');
                const content = this.querySelector('.dropdown-content');
                toggle.classList.remove('active');
                content.style.maxHeight = '0';
                setTimeout(() => {
                    content.classList.add('hidden');
                }, 300);
            });
        });
        */
