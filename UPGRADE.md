# Upgrade Notes
![upgrade](https://user-images.githubusercontent.com/700119/31535145-3c01a264-affa-11e7-8d86-f04c33571f65.png)  
***
After every update you should check the pimcore extension manager. Just click the "update" button to finish the bundle update.

#### Update from Version 2.x to Version 2.1.0
- **[NEW FEATURE]**: [Conditional Logic](docs/81_ConditionalLogic.md) implemented
- **[NEW FEATURE]**: Field *Country* Field added
- **[NEW FEATURE]**: Field *[Dynamic Choice Field](docs/82_DynamicChoice.md)* added
- **[NEW FEATURE]**: [jQuery Plugins](docs/91_Javascript.md) available
- **[BC BREAK]**: *"Mark field as required"* has been removed. Please check your form and add a "not-blank" constraint to every required field!
- **[BC BREAK]**: `formbuilder.js` has been moved to `bundles/formbuilder/js/frontend/legacy`. This file is now deprecated and will be removed in Version 3.0.0!
- **[BC BREAK]**: `jquery.fine-uploader.js` has been moved to `bundles/formbuilder/js/frontend/vendor`.

#### Update from Version 1.x to Version 2.0.0
- TBD