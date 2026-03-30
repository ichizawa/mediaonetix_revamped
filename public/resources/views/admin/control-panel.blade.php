@extends('layouts')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h1 class="fw-bold mb-3">Control Panel</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm clickable-card" data-target="#systemSettingsModal" data-bs-toggle="modal"
                    style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>System Settings</span>
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Configure global system settings, timezone, currency, and locale
                            preferences.</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Maintenance Mode</span>
                            <span class="badge bg-primary">Timezone</span>
                            <span class="badge bg-primary">Currency</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm clickable-card" data-target="#experimentalFeaturesModal"
                    data-bs-toggle="modal" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>Experimental Features</span>
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Enable and configure experimental features and beta functionality.</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Beta Features</span>
                            <span class="badge bg-primary">Experimental</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm clickable-card" data-target="#securityControlsModal" data-bs-toggle="modal"
                    style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>Security Controls</span>
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Manage password policies, expiration rules, and complexity requirements.
                        </p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Password Length</span>
                            <span class="badge bg-primary">Expiration</span>
                            <span class="badge bg-primary">Complexity</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm clickable-card" data-target="#contentCustomizationModal"
                    data-bs-toggle="modal" style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>Page & Content Customization</span>
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Edit landing page, FAQs, About Us, and policy pages for your site.</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Landing Page</span>
                            <span class="badge bg-primary">FAQs</span>
                            <span class="badge bg-primary">Policies</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 shadow-sm clickable-card" data-target="#instatusModal" data-bs-toggle="modal"
                    style="cursor: pointer; transition: all 0.3s ease;">
                    <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                        <span>Instatus Settings</span>
                        <i class="fas fa-server"></i>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-0">Configure your Instatus status page integration and downtime display
                            settings.</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Instatus URL</span>
                            <span class="badge bg-primary">Slug</span>
                            <span class="badge bg-primary">Downtime Toggle</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="systemSettingsModal" tabindex="-1" aria-labelledby="systemSettingsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="systemSettingsModalLabel">System Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="maintenance_mode">
                        <label class="form-check-label" for="maintenance_mode">
                            Maintenance Mode (Enable/Disable Global Access)
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="timezone" class="form-label">Timezone</label>
                        <select class="form-select" id="timezone">
                            <option value="">Select timezone</option>
                            <option value="Asia/Manila">Asia/Manila</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="currency" class="form-label">Currency</label>
                        <select class="form-select" id="currency">
                            <option value="PHP">PHP</option>
                        </select>
                    </div>

                    <!-- Locale Selector -->
                    <div class="mb-3">
                        <label for="locale" class="form-label">Locale</label>
                        <select class="form-select" id="locale">
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Settings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="experimentalFeaturesModal" tabindex="-1" aria-labelledby="experimentalFeaturesModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="experimentalFeaturesModalLabel">Experimental Features</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="beta_features">
                        <label class="form-check-label" for="beta_features">
                            Enable Beta Features
                        </label>
                    </div>
                    <div class="alert alert-warning" role="alert">
                        <strong>Warning:</strong> Experimental features may be unstable and should be used with caution.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Update Features</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="securityControlsModal" tabindex="-1" aria-labelledby="securityControlsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Security Controls</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="minPasswordLength" class="form-label">Minimum Password Length</label>
                        <input type="number" class="form-control" id="minPasswordLength" value="8">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password Complexity</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="requireUppercase">
                            <label class="form-check-label" for="requireUppercase">Require Uppercase Letters</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="requireNumbers">
                            <label class="form-check-label" for="requireNumbers">Require Numbers</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="requireSpecialChars">
                            <label class="form-check-label" for="requireSpecialChars">Require Special Characters</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="passwordExpiration" class="form-label">Password Expiration (Days)</label>
                        <input type="number" class="form-control" id="passwordExpiration" value="90">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save Security Settings</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contentCustomizationModal" tabindex="-1" aria-labelledby="contentCustomizationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Page & Content Customization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="landingPageContent" class="form-label">Landing Page Content</label>
                        <textarea class="form-control" id="landingPageContent" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="faqsContent" class="form-label">FAQs</label>
                        <textarea class="form-control" id="faqsContent" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="aboutUsContent" class="form-label">About Us</label>
                        <textarea class="form-control" id="aboutUsContent" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="termsContent" class="form-label">Terms & Conditions</label>
                        <textarea class="form-control" id="termsContent" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="privacyContent" class="form-label">Privacy Policy</label>
                        <textarea class="form-control" id="privacyContent" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-success">Save Content</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="instatusModal" tabindex="-1" aria-labelledby="instatusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="instatusModalLabel">Instatus Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="instatus_url" class="form-label">Instatus Page URL</label>
                        <input type="url" class="form-control" id="instatus_url" placeholder="https://status.example.com">
                    </div>

                    <div class="mb-3">
                        <label for="instatus_slug" class="form-label">URL Slug</label>
                        <input type="text" class="form-control" id="instatus_slug" placeholder="example-status">
                    </div>

                    <div class="mb-3">
                        <label for="show_downtime" class="form-label">Site Downtime</label>
                        <input type="number" class="form-control" id="show_downtime">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Save Instatus Settings</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .clickable-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .clickable-card:active {
            transform: translateY(0);
        }

        .badge {
            font-size: 0.75em;
            margin-right: 0.5rem;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.clickable-card').forEach(function (card) {
                card.addEventListener('click', function () {
                    const target = this.getAttribute('data-target');
                    const modal = new bootstrap.Modal(document.querySelector(target));
                    modal.show();
                });
            });

            document.querySelectorAll('.modal').forEach(function (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        bootstrap.Modal.getInstance(this).hide();
                    }
                });
            });
        });
    </script>
@endsection
