import React from 'react'
import {mount} from 'enzyme'
import {spyConsole, renew, ensure, mockGlobals} from '#/main/core/scaffolding/tests'
import {WordsPlayer} from '#/plugin/exo/items/words/components/player'

describe('<WordsPlayer/>', () => {
  beforeEach(() => {
    spyConsole.watch()
    renew(WordsPlayer, 'WordsPlayer')
  })
  afterEach(spyConsole.restore)

  it('renders a word player and dispatches answers', () => {

    const player = mount(
      <WordsPlayer
        item={{
          id: 'ID',
          contentType: 'text',
          maxLength: 42
        }}
        onChange={() => {}}
      />
    )

    ensure.propTypesOk()
    const textBox = player.find('div[role="textbox"]')
    ensure.equal(textBox.length, 1)
  })
})
