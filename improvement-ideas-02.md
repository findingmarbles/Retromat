# Symfony 5.4 Best Practices - Project Structure Improvements

*Analysis conducted against the official [Symfony 5.4 Best Practices](https://symfony.com/doc/5.x/best_practices.html)*

## 🔥 HIGH PRIORITY (Critical for Standards Compliance)

### 1. **Migrate from Annotations to Attributes** 
- **Impact**: High - Future-proofing and modern Symfony standards
- **Effort**: Medium
- **Details**: 
  - Convert all `@ORM\` annotations to `#[ORM\]` attributes in entities
  - Convert remaining `@Route` annotations to `#[Route]` attributes in controllers
  - Update validation constraints from `@Assert\` to `#[Assert\]`
- **Files Affected**: `src/Entity/*.php`, some controllers in `src/Controller/`
- **Benefits**: Better IDE support, type safety, future Symfony compatibility

### 2. **Restructure Project Directory Layout**
- **Impact**: High - Fundamental architecture alignment
- **Effort**: High
- **Details**:
  - Move all `backend/` contents to project root to follow standard Symfony structure
  - Ensure root contains: `bin/`, `config/`, `public/`, `src/`, `templates/`, `tests/`, `translations/`, `var/`, `vendor/`
  - Update Docker configurations and deployment scripts accordingly
- **Current Issue**: Non-standard `backend/` subdirectory structure
- **Benefits**: Standard Symfony structure, better tool compatibility, clearer project organization

### 3. **Clean Up Security Configuration**
- **Impact**: Medium-High - Removes deprecated patterns
- **Effort**: Low
- **Details**:
  - Remove deprecated `encoders` section from `security.yaml` (already have `password_hashers`)
  - Consolidate password hashing strategy to use only `password_hashers`
- **File**: `backend/config/packages/security.yaml`
- **Benefits**: Removes deprecated configuration, cleaner setup

## ⚡ MEDIUM PRIORITY (Important for Best Practices)

### 4. **Migrate Translations to XLIFF Format**
- **Impact**: Medium - Better i18n practices
- **Effort**: Medium
- **Details**:
  - Convert `messages.en.yaml` → `messages.en.xlf`
  - Convert `messages.de.yaml` → `messages.de.xlf`
  - Update translation keys to be more descriptive (e.g., `'form.submit.button'` instead of content strings)
- **Current**: Using YAML format
- **Benefits**: Better translation workflow, industry standard, more metadata support

### 5. **Add Missing Assets Directory Structure**
- **Impact**: Medium - Standard Symfony frontend setup
- **Effort**: Low-Medium
- **Details**:
  - Create `assets/` directory with standard subdirectories (`css/`, `js/`, `images/`)
  - Consider migrating existing static assets from `public/static/` to `assets/` 
  - Set up Webpack Encore if not already configured
- **Benefits**: Modern asset management, better build process

### 6. **Optimize Service Configuration**
- **Impact**: Medium - Performance and best practices
- **Effort**: Low
- **Details**:
  - Add explicit service definitions for complex services in `config/services.yaml`
  - Ensure all services are properly private (don't expose via container)
  - Add app-specific parameters with `app.*` prefix instead of hardcoded values
- **Files**: `backend/config/services.yaml`, `backend/config/retromat/*.yaml`

### 7. **Standardize Template Naming**
- **Impact**: Medium - Consistency with Symfony conventions  
- **Effort**: Medium
- **Details**:
  - Ensure all template files use snake_case naming
  - Prefix template fragments with underscore (e.g., `_navigation.html.twig`)
  - Review current templates in `backend/templates/` for naming consistency
- **Benefits**: Better Symfony conventions compliance

## 📋 LOW PRIORITY (Nice to Have)

### 8. **Environment Configuration Improvements**
- **Impact**: Low-Medium - Better deployment practices
- **Effort**: Low
- **Details**:
  - Review and standardize use of environment variables vs parameters vs constants
  - Ensure sensitive data uses Symfony secrets management
  - Document configuration approach in README

### 9. **Add Missing Configuration Optimizations**
- **Impact**: Low - Performance improvements
- **Effort**: Low
- **Details**:
  - Add `container.dumper.inline_factories: true` to framework config (already present in Kernel)
  - Review cache configuration for production optimizations
  - Add explicit OPcache configuration recommendations

### 10. **Form Organization Review**
- **Impact**: Low - Code organization
- **Effort**: Low
- **Details**:
  - Ensure form buttons are added in templates, not form classes (current implementation looks correct)
  - Review form type organization in `src/Form/`
- **Status**: Current implementation appears to follow best practices

### 11. **Testing Structure Enhancement**
- **Impact**: Low-Medium - Better testing practices
- **Effort**: Medium
- **Details**:
  - Add smoke tests for all public URLs
  - Implement hard-coded URL testing as recommended
  - Review current test structure in `backend/tests/`

### 12. **Performance Configuration**
- **Impact**: Low - Production optimization
- **Effort**: Low
- **Details**:
  - Document OPcache setup for production
  - Add composer autoloader optimization to deployment scripts
  - Review cache strategy configuration

## 📊 Implementation Roadmap

### Phase 1: Critical Infrastructure (Weeks 1-2)
- Items #1, #2, #3 (Attributes migration, directory restructure, security cleanup)

### Phase 2: Standards Alignment (Weeks 3-4)  
- Items #4, #5, #6 (Translations, assets, services)

### Phase 3: Polish & Optimization (Week 5)
- Items #7-12 (Templates, environment, performance)

## 🎯 Success Metrics

- [ ] All entities and controllers use PHP 8.1+ attributes
- [ ] Project follows standard Symfony directory structure
- [ ] No deprecated configuration warnings
- [ ] Translations follow XLIFF format with descriptive keys
- [ ] Assets properly organized and managed
- [ ] All services properly configured and private
- [ ] Templates follow snake_case naming conventions

## 📝 Notes

- Current project already follows many Symfony 5.4 best practices well
- The biggest architectural change needed is the directory restructure (#2)
- Most improvements are incremental and can be done without breaking changes
- Quality tooling (PHP-CS-Fixer, PHPStan) is already in place, which is excellent 