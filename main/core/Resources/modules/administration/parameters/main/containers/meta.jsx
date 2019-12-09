import {connect} from 'react-redux'

import {actions as formActions} from '#/main/app/content/form/store'

import {selectors} from '#/main/core/administration/parameters/store/selectors'
import {Meta as MetaComponent} from '#/main/core/administration/parameters/main/components/meta'

const Meta = connect(
  null,
  (dispatch) => ({
    updateProp(prop, value) {
      dispatch(formActions.updateProp(selectors.FORM_NAME, prop, value))
    }
  })
)(MetaComponent)

export {
  Meta
}